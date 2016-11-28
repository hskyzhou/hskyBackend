<?php

namespace App\Services\Backend;

use App\Repositories\Eloquent\RoleRepositoryEloquent;

use App\Traits\ServiceTrait;
class RoleService{
	use ServiceTrait;

	protected $roleRepo;

	public function __construct(RoleRepositoryEloquent $roleRepo){
		$this->roleRepo = $roleRepo;
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
}