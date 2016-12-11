<?php

namespace App\Services\Backend;

use App\Repositories\Eloquent\RoleRepositoryEloquent;
use App\Repositories\Eloquent\PermissionRepositoryEloquent;

use App\Traits\ServiceTrait;

use App\Repositories\Criteria\FilterNameCriteria;
use App\Repositories\Criteria\FilterSlugCriteria;
use App\Repositories\Criteria\FilterDescriptionCriteria;
use App\Repositories\Criteria\FilterCreatedAtCriteria;
use App\Repositories\Criteria\OffsetLimitCriteria;
use App\Repositories\Criteria\StatusActiveCriteria;

use DB, Exception;

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

	//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	public function datatables(){
		$draw = request('draw', 1);

		$offset = request('start', 0);
		$limit = request('length', 10);

		/*处理参数*/
		$wheres = [];

		if($name = request('name', '')){
			$this->roleRepo->pushCriteria(new FilterNameCriteria($name));
		}

		if($slug = request('slug', '')){
			$this->roleRepo->pushCriteria(new FilterSlugCriteria($slug));
		}

		if($description = request('description', '')){
			$this->roleRepo->pushCriteria(new FilterDescriptionCriteria($description));
		}
		
		if($created_at = request('created_at', '')){
			$this->roleRepo->pushCriteria(new FilterCreatedAtCriteria($created_at));
		}

		$count = $this->roleRepo->count();

		$this->roleRepo->pushCriteria(new OffsetLimitCriteria($offset, $limit));
		$datas = $this->roleRepo->all()->map(function($item, $key){
            $id = $item->id;
            return [
                'checkbox' => $this->createCheckbox($id),
                'name' => $item->name,
                'slug' => $item->slug,
                'description' => $item->description,
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
	    $updateUrl = route('role.edit', [$id]);
	    $destroyUrl = route('role.destroy', [$id]);
	    $deleteUrl = route('role.delete', [$id]);
	    $restoreUrl = route('role.restore', [$id]);

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
		$permissions = $this->permissionRepo->permissionList();

		return [
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

				try {
					$role = $this->roleRepo->create($data);
				} catch (Exception $e) {
					throw new Exception("角色创建失败");
				}

				try {
					$permissionIds = request('permission', []);
					$role->permissions()->attach($permissionIds);	
				} catch (Exception $e) {
					throw new Exception("角色绑定权限失败");
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
			'role' => '',
			'permissions' => collect([]),
		];

		try {
			$role = $this->roleRepo->skipCriteria()->with('permissions')->find($id);

			$permissions = $this->permissionRepo->permissionList();

			$returnData = array_merge($returnData, [
				'result' => true,
				'message' => '获取成功',
				'role' => $role,
				'permissions' => $permissions
			]);
		} catch (Exception $e) {
		}

		return $returnData;
	}

	public function update($id){
		$returnData = [
			'result' => false,
			'message' => '角色修改失败',
		];

		try {
			$exception = DB::transaction(function() use ($id){
				try {
					$data = request()->all();
					$role = $this->roleRepo->update($data, $id);
				} catch (Exception $e) {
					throw new Exception("角色修改失败");
				}

				try {
					$permissionIds = request('permission', []);
					$role->permissions()->sync($permissionIds);
				} catch (Exception $e) {
					throw new Exception("角色绑定权限失败");
				}
				return [
					'result' => true,
					'message' => '角色修改成功'
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


	//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||	
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

	//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||	
	public function destroy($id){
		$returnData = [
		    'result' => false,
		    'message' => '彻底删除失败',
		];

		try {
			$info = $this->roleRepo->find($id);
			
			if($info->status == getStatusClose()){
				if($this->roleRepo->destroy($id)){
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
			dd($e);
			$returnData = array_merge($returnData, [
			    'message' => '查无记录',
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
} 