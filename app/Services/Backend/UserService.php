<?php

namespace App\Services\Backend;

use App\Repositories\Eloquent\UserRepositoryEloquent;
use App\Repositories\Eloquent\RoleRepositoryEloquent;
use App\Repositories\Eloquent\PermissionRepositoryEloquent;

use App\Traits\ServiceTrait;

use App\Repositories\Criteria\FilterNameCriteria;
use App\Repositories\Criteria\FilterEmailCriteria;
use App\Repositories\Criteria\FilterCreatedAtCriteria;
use App\Repositories\Criteria\OffsetLimitCriteria;
// use App\Repositories\Criteria\StatusActiveCriteria;

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

	//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	public function datatables(){
		$draw = request('draw', 1);

		$offset = request('start', 0);
		$limit = request('length', 10);

		/*处理参数*/
		if($name = request('name', '')){
			$this->userRepo->pushCriteria(new FilterNameCriteria($name));
		}

		if($email = request('email', '')){
			$this->userRepo->pushCriteria(new FilterEmailCriteria($email));
		}

		if($created_at = request('created_at', '')){
			$this->userRepo->pushCriteria(new FilterCreatedAtCriteria($created_at));
		}

		$count = $this->userRepo->count();

		$datas = $this->userRepo->all()->map(function($item, $key){
		    $id = $item->id;
		    return [
		        'checkbox' => $this->createCheckbox($id),
		        'name' => $item->name,
		        'email' => $item->email,
		        'created_at' => $item->created_at->toDateString(),
		        'button' => $this->createButton($id, $item->status),
		    ];
		});

		return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $datas
        ];
	}

	private function createButton($id, $status){
	    $updateUrl = route('user.edit', [$id]);
	    $destroyUrl = route('user.destroy', [$id]);
	    $deleteUrl = route('user.delete', [$id]);
	    $restoreUrl = route('user.restore', [$id]);

	    $btnUpdate = "<a class='btn yellow btn-outline sbold' href='{$updateUrl}'><i class='fa fa-pencil'></i></a>";
	    $btnOther = "";
	    if($status == getStatusActive()){
	        /*删除*/
	        $btnOther .= "<a data-url='{$deleteUrl}' class='btn red btn-outline sbold filter-delete'><i class='fa fa-times'></i></a>";
	    }else{
	        /*彻底删除*/
	        $btnOther .= "<a data-url='{$destroyUrl}' class='btn red btn-outline sbold filter-full-delete'><i class='fa fa-ban'></i></a>";
	        /*恢复*/
	        $btnOther .= "<a data-url='{$restoreUrl}' class='btn green btn-outline sbold filter-restore'><i class='fa fa-reply'></i></a>";
	    }

	    return $btnUpdate . $btnOther;
	}

	private function createCheckbox($id){
	    return "<input type='checkbox' name='id[]' value='{$id}'>";
	}

	//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	public function create(){
		$roles = $this->roleRepo->all();
		$permissions = $this->permissionRepo->permissionList();

		return [
			'roles' => $roles,
			'permissions' => $permissions
		];
	}

	public function store(){
		$returnData = [
			'result' => false,
			'message' => '保存失败'
		];

		try {
			$exception = DB::transaction(function(){
				$data = request()->all();
				$data['password'] = bcrypt($data['password']);

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

	//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	public function edit($id){
		$returnData = [
			'result' => false,
			'message' => '获取角色信息失败',
			'user' => '',
			'roles' => collect([]),
			'permissions' => collect([]),
		];

		try {
			$user = $this->userRepo->with(['roles', 'userPermissions'])->find($id);
			$roles = $this->roleRepo->all();
			$permissions = $this->permissionRepo->permissionList();
			
			$returnData = array_merge($returnData, [
				'result' => true,
				'message' => '获取成功',
				'user' => $user,
				'roles' => $roles,
				'permissions' => $permissions
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

	//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	/*逻辑删除单个*/
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

	/*逻辑删除多个*/
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

	//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	/*恢复单个 */
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

	/*恢复多个*/
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

	//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	/*物理删除单个*/
	public function destroy($id){
		$returnData = [
		    'result' => false,
		    'message' => '彻底删除失败',
		];

		try {
			$info = $this->userRepo->find($id);
			
			if($info->status == getStatusClose()){
				if($this->userRepo->destroy($id)){
					$returnData = array_merge($returnData, [
	                    'result' => true,
	                    'message' => '彻底删除成功',
	                ]);
				}else{
					$returnData = array_merge($returnData, [
					    'message' => '彻底删除失败',
					]);
				}
			}else{
				$returnData = array_merge($returnData, [
                    'result' => false,
                    'message' => '请先删除',
                ]);
			}
		} catch (Exception $e) {
			$returnData = array_merge($returnData, [
			    'message' => '查无记录',
			]);
		}
		
		return $returnData;
	}

	/*物理删除多个*/
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
} 