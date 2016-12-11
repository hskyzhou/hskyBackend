<?php
namespace App\Services\Backend;

use App\Repositories\Eloquent\PermissionRepositoryEloquent as Permission;
use App\Traits\ServiceTrait;

/*criteria*/
use App\Repositories\Criteria\FilterNameCriteria;
use App\Repositories\Criteria\FilterSlugCriteria;
use App\Repositories\Criteria\FilterDescriptionCriteria;
use App\Repositories\Criteria\FilterPositionCriteria;
use App\Repositories\Criteria\FilterCreatedAtCriteria;
use App\Repositories\Criteria\OffsetLimitCriteria;
use App\Repositories\Criteria\StatusActiveCriteria;

use Exception;

class PermissionService{
	use ServiceTrait;

	protected $permissionRepo;

	public function __construct(Permission $permissionRepo){
			$this->permissionRepo = $permissionRepo;
	}

	//||||||||||||||||||||||||||||||||||||||||||||||
	/*获取datatable 列表*/
	public function datatables(){
		$draw = request('draw', 1);

		$offset = request('start', 0);
		$limit = request('length', 10);

		/*处理参数*/
		$this->permissionRepo->resetCriteria(); //过滤所有标准

		if($name = request('name', '')){
			$this->permissionRepo->pushCriteria(new FilterNameCriteria($name));
		}

		if($slug = request('slug', '')){
			$this->permissionRepo->pushCriteria(new FilterSlugCriteria($slug));
		}

		if($description = request('description', '')){
			$this->permissionRepo->pushCriteria(new FilterDescriptionCriteria($description));
		}

		if($position = request('position', '')){
			$this->permissionRepo->pushCriteria(new FilterPositionCriteria($position));
		}
		
		if($created_at = request('created_at', '')){
			$this->permissionRepo->pushCriteria(new FilterCreatedAtCriteria($created_at));
		}

		$count = $this->permissionRepo->count();

		$this->permissionRepo->pushCriteria(new OffsetLimitCriteria($offset, $limit));
		$datas = $this->permissionRepo->all()->map(function($item, $key){
            $id = $item->id;
            return [
                'checkbox' => $this->createCheckbox($id),
                'name' => $item->name,
                'slug' => $item->slug,
                'description' => $item->description,
                'position' => $item->position,
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
	    $updateUrl = route('permission.edit', [$id]);
	    $destroyUrl = route('permission.destroy', [$id]);
	    $deleteUrl = route('permission.delete', [$id]);
	    $restoreUrl = route('permission.restore', [$id]);

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
	//||||||||||||||||||||||||||||||||||||||||||||||

	public function create(){
		$permissions = $this->permissionRepo->permissionList();

		return [
			'permissions' => $permissions
		];
	}

	public function store(){
		$returnData = [
			'result' => false,
			'message' => '添加失败'
		];

		$data = [
			'name' => request('name'),
			'slug' => request('slug'),
			'position' => request('position'),
			'status' => request('status'),
			'description' => request('description', ''),
			'model' => request('model', '')
		];

		if($permissionInfo = $this->permissionRepo->create($data)){
			/*添加前置权限*/
			$permissions = request('permission');
			$permissionInfo->prePermissions()->attach($permissions);

			/*记录日志*/
			$this->recordLog();

			$returnData = array_merge($returnData, [
				'result' => true,
				'message' => '添加成功'
			]);
		}else{
			/*记录日志*/
			$this->recordLog();
		}

		return $returnData;
	}

	public function edit($id){
		$returnData = [
			'result' => false,
			'message' => '获取失败',
			'info' => '',
			'permissions' => collect([]),
		];

		$permissions = $this->permissionRepo->permissionList();

		$info = $this->permissionRepo->with('prePermissions')->find($id);

		if($info){
			$returnData = array_merge($returnData, [
				'result' => true,
				'message' => '获取成功',
				'info' => $info,
				'permissions' => $permissions,
			]);
		}

		return $returnData;
	}

	public function update($id){
		$returnData = [
			'result' => false,
			'message' => '修改失败'
		];

		$data = [
			'name' => request('name'),
			'slug' => request('slug'),
			'position' => request('position'),
			'status' => request('status'),
			'description' => request('description', ''),
			'model' => request('model', '')
		];

		$info = $this->permissionRepo->find($id);
		if($info){
			if($this->permissionRepo->update($data, $id)){
				/*修改前置权限*/
				$permissions = request('permission');
				$info->prePermissions()->sync($permissions);

				$returnData = array_merge($returnData, [
					'result' => true,
					'message' => '修改成功'
				]);
			}else{
				/*记录日志*/
				$this->recordLog();
			}
		}else{
			/* 进行保存*/
			$returnData = $this->store();
		}

		return $returnData;
	}

	/*临时删除*/
	public function delete($id){
		$returnData = [
		    'result' => false,
		    'message' => '删除失败',
		];

		$info = $this->permissionRepo->find($id);

		if($info){
			if($this->permissionRepo->delete($id)){
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
		
		return $returnData;
	}

	public function deleteMore(){
		$returnData = [
			'result' => false,
			'message' => '删除失败'
		];
		$ids = request('ids', []);
		if(!empty($ids)){
			if($this->permissionRepo->deleteMore($ids)){
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

	/*彻底删除*/
	public function destroy($id){
		$returnData = [
		    'result' => false,
		    'message' => '彻底删除失败',
		];

		try {
			$info = $this->permissionRepo->find($id);
			
			if($info->status == getStatusClose()){
				if($this->permissionRepo->destroy($id)){
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
			if($this->permissionRepo->destroyMore($ids)){
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

	/*恢复临时删除数据*/
	public function restore($id){
		$returnData = [
			'result' => false,
			'message' => '恢复失败'
		];
		if($this->permissionRepo->restore($id)){
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
			if($this->permissionRepo->restoreMore($ids)){
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
}