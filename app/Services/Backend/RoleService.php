<?php

namespace App\Services\Backend;

use App\Repositories\Eloquent\RoleRepositoryEloquent;
use App\Repositories\Eloquent\PermissionRepositoryEloquent;

use App\Traits\ServiceTrait;

use App\Repositories\Criteria\Role\StatusActiveCriteria;

class RoleService{
	use ServiceTrait;

	protected $roleRepo;
	protected $permissionRepo;

	public function __construct(
		RoleRepositoryEloquent $roleRepo,
		PermissionRepositoryEloquent $permissionRepo
	){
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

		$slug = request('slug', '');
		if($slug){
		    $wheres['slug'] = $slug;
		}

		$description = request('description', '');
		if($description){
		    $wheres['description'] = $description;
		}

		$created_at = request('created_at', '');
		if($created_at){
		    $wheres['created_at'] = $created_at;
		}

		$datas = $this->roleRepo->datatables($wheres, $limit, $offset);

		$count = $this->roleRepo->datatablesCount($wheres);

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
			$info = $this->roleRepo->find($id);
			
			if($info){
				if($this->roleRepo->delete($id)){
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

		if($this->roleRepo->restore($id)){
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
			if($this->roleRepo->deleteMore($ids)){
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
			if($this->roleRepo->restoreMore($ids)){
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
			if($this->roleRepo->destroyMore($ids)){
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
		$permissions = $this->permissionRepo->with(['prePermissions'])->all();

		$dealPermissions = [];
		if(!$permissions->isEmpty()){
			$dealPermissions = $this->dealCreatePermissions($permissions);
		}

		return [
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
} 