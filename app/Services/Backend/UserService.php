<?php

namespace App\Services\Backend;

use App\Repositories\Eloquent\UserRepositoryEloquent;
use App\Repositories\Eloquent\RoleRepositoryEloquent;
use App\Repositories\Eloquent\PermissionRepositoryEloquent;

use App\Traits\ServiceTrait;

use App\Repositories\Criteria\Role\StatusActiveCriteria;

use DB, Exception;

class UserService{
	use ServiceTrait;

	protected $userRepo;
	protected $roleRepo;
	protected $permissionRepo;

	public function __construct(
		UserRepositoryEloquent $userRepo,
		RoleRepositoryEloquent $roleRepo,
		PermissionRepositoryEloquent $permissionRepo
	){
		$this->userRepo = $userRepo;
		$this->roleRepo = $roleRepo;
		$this->permissionRepo = $permissionRepo;
	}

	public function datatables(){
		$draw = request('draw', 1);

		$offset = request('start', 0);
		$limit = request('length', 10);

		/*处理参数*/
		$wheres = [];

		$name = request('name', '');
		if($name){
		    $wheres['name'] = $name;
		}

		$email = request('email', '');
		if($email){
		    $wheres['email'] = $email;
		}

		$created_at = request('created_at', '');
		if($created_at){
		    $wheres['created_at'] = $created_at;
		}

		$datas = $this->userRepo->datatables($wheres, $limit, $offset);

		$count = $this->userRepo->datatablesCount($wheres);

		return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $datas
        ];
	}

	public function delete($id){
		$returnData = [
		    'result' => false,
		    'message' => '删除失败',
		];

		try {
			$info = $this->userRepo->find($id);
			
			if($info){
				if($this->userRepo->delete($id)){
					$returnData = array_merge($returnData, [
	                    'result' => true,
	                    'message' => '删除成功',
	                ]);
				}else{
					$returnData = array_merge($returnData, [
					    'message' => '删除失败',
					]);
				}
			}else{
				$returnData = array_merge($returnData, [
				    'message' => '查无记录',
				]);
			}
		} catch (Exception $e) {
			
		}
		return $returnData;
	}

	/*恢复 */
	public function restore($id){
		$returnData = [
			'result' => false,
			'message' => '恢复失败',
		];

		if($this->userRepo->restore($id)){
			$returnData = array_merge($returnData, [
				'result' => true,
				'message' => '恢复成功'
			]);
		}
		return $returnData;
	}

	public function deleteMore(){
		$returnData = [
			'result' => false,
			'message' => '删除失败'
		];
		$ids = request('ids', []);
		if(!empty($ids)){
			if($this->userRepo->deleteMore($ids)){
				$returnData = array_merge($returnData, [
					'result' => true,
					'message' => ' 删除成功'
				]);
			}else{
				$returnData = array_merge($returnData, [
					'message' => ' 删除失败'
				]);
			}
		}else{
			$returnData = array_merge($returnData, [
				'message' => '未选中删除记录'
			]);
		}
		return $returnData;
	}

	public function restoreMore(){
		$returnData = [
			'result' => false,
			'message' => '恢复失败',
		];

		$ids = request('ids', []);

		if(!empty($ids)){
			if($this->userRepo->restoreMore($ids)){
				$returnData = array_merge($returnData, [
					'result' => true,
					'message' => ' 恢复成功'
				]);
			}else{
				$returnData = array_merge($returnData, [
					'message' => ' 恢复失败'
				]);
			}
		}else{
			$returnData = array_merge($returnData, [
				'message' => '未选中恢复记录'
			]);
		}
		return $returnData;
	}

	public function destroyMore(){
		$returnData = [
			'result' => false,
			'message' => '彻底删除失败'
		];
		$ids = request('ids', []);
		if(!empty($ids)){
			if($this->userRepo->destroyMore($ids)){
				$returnData = array_merge($returnData, [
					'result' => true,
					'message' => ' 彻底删除成功'
				]);
			}else{
				$returnData = array_merge($returnData, [
					'message' => ' 彻底删除失败'
				]);
			}
		}else{
			$returnData = array_merge($returnData, [
				'message' => '未选中彻底删除记录'
			]);
		}
		return $returnData;
	}

	public function create(){
		$roles = $this->roleRepo->all();

		$permissions = $this->permissionRepo->with(['prePermissions'])->all();

		$dealPermissions = [];
		if(!$permissions->isEmpty()){
			$dealPermissions = $this->dealCreatePermissions($permissions);
		}

		return [
			'roles' => $roles,
			'permissions' => $dealPermissions
		];
	}

	private function dealCreatePermissions($permissions){
		$results = [];
		foreach($permissions as $permission){
			$slugs = explode('.', $permission->slug);
			$results[$slugs[0]][] = [
				'id' => $permission->id,
				'name' => $permission->name,
				'slug' => $permission->slug,
				'childs' => $permission->prePermissions
			];
		}
		return $results;
	}

	public function store(){
		$returnData = [
			'result' => false,
			'message' => '保存失败'
		];

		try {
			$exception = DB::transaction(function(){
				$data = request()->all();

				try {
					$user = $this->userRepo->create($data);
				} catch (Exception $e) {
					throw new Exception("用户创建失败");
				}

				try {
					$roleIds = request('role', []);
					$user->roles()->attach($roleIds);	
				} catch (Exception $e) {
					throw new Exception("用户绑定角色失败");
				}	

				try {
					$permissionIds = request('permission', []);
					$user->userPermissions()->attach($permissionIds);	
				} catch (Exception $e) {
					throw new Exception("用户绑定权限失败");
				}	

				return [
					'result' => true,
					'message' => '保存成功'
				];
			});
			$returnData = array_merge($returnData, $exception);
		} catch (Exception $e) {
			$returnData = array_merge($returnData, [
				'message' => $e->getMessage(),
			]);
		}
		
		return $returnData;
	}

	public function edit($id){
		$returnData = [
			'result' => false,
			'message' => '获取角色信息失败',
			'user' => '',
			'roles' => collect([]),
			'permissions' => collect([]),
		];

		try {
			$user = $this->userRepo->skipCriteria()->with(['roles', 'userPermissions'])->find($id);

			$roles = $this->roleRepo->all();
			$permissions = $this->permissionRepo->with(['prePermissions'])->all();

			$dealPermissions = [];
			if(!$permissions->isEmpty()){
				$dealPermissions = $this->dealCreatePermissions($permissions);
			}
			
			$returnData = array_merge($returnData, [
				'result' => true,
				'message' => '获取成功',
				'user' => $user,
				'roles' => $roles,
				'permissions' => $dealPermissions
			]);
		} catch (Exception $e) {
			
		}

		return $returnData;
	}

	public function update($id){
		$returnData = [
			'result' => false,
			'message' => '用户修改失败',
		];

		try {
			$exception = DB::transaction(function() use ($id){
				try {
					$data = request()->all();
					$user = $this->userRepo->update($data, $id);
				} catch (Exception $e) {
					throw new Exception("角色修改失败");
				}

				try {
					$roleIds = request('role', []);
					$user->roles()->sync($roleIds);
				} catch (Exception $e) {
					throw new Exception("用户绑定角色失败");
				}

				try {
					$permissionIds = request('permission', []);
					$user->userPermissions()->sync($permissionIds);
				} catch (Exception $e) {
					throw new Exception("用户绑定权限失败");
				}
				return [
					'result' => true,
					'message' => '用户修改成功'
				];
			});
			$returnData = array_merge($returnData, $exception);
		} catch (Exception $e) {
			$returnData = array_merge($returnData, [
				'message' => $e->getMessage(),
			]);
		}
		return $returnData;
	}
} 