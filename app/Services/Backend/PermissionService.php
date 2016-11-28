<?php
namespace App\Services\Backend;

use App\Repositories\Eloquent\PermissionRepositoryEloquent as Permission;
use App\Traits\ServiceTrait;

class PermissionService{
	use ServiceTrait;

	protected $permissionRepo;

	public function __construct(Permission $permissionRepo){
			$this->permissionRepo = $permissionRepo;
	}

	public function permissionsManage(){
		return $this->permissionRepo->permissionsManage();
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

		$position = request('position', '');
		if($position){
		    $wheres['position'] = $position;
		}

		$created_at = request('created_at', '');
		if($created_at){
		    $wheres['created_at'] = $created_at;
		}

		$datas = $this->permissionRepo->datatables($wheres, $limit, $offset);

		$count = $this->permissionRepo->datatablesCount($wheres);

		return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $datas
        ];
	}

	/*彻底删除*/
	public function destroy($id){
		$returnData = [
		    'result' => false,
		    'message' => '彻底删除失败',
		];

		$info = $this->permissionRepo->find($id);

		if($info){
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
		}else{
			$returnData = array_merge($returnData, [
			    'message' => '查无记录',
			]);
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

		if($this->permissionRepo->create($data)){
			$returnData = array_merge($returnData, [
				'result' => true,
				'message' => '添加成功'
			]);
		}else{
			$returnData = array_merge($returnData, [
				'message' => '添加失败'
			]);
		}

		return $returnData;
	}

	public function edit($id){
		$returnData = [
			'result' => false,
			'message' => '获取失败',
			'info' => '',
		];

		$info = $this->permissionRepo->find($id);

		if($info){
			$returnData = array_merge($returnData, [
				'result' => true,
				'message' => '获取成功',
				'info' => $info
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
				$returnData = array_merge($returnData, [
					'result' => true,
					'message' => '修改成功'
				]);
			}
		}else{
			/* 进行保存*/
			$returnData = $this->store();
		}

		return $returnData;
	}
}