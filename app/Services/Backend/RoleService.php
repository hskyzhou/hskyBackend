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

}