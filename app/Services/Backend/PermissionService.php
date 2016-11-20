<?php
	namespace App\Services\Backend;

	use App\Repositories\Eloquent\PermissionRepositoryEloquent as Permission;
	class PermissionService{

		protected $permissionRepo;

		public function __construct(Permission $permissionRepo){
				$this->permissionRepo = $permissionRepo;
		}

		public function permissionsManage(){
			return $this->permissionRepo->permissionsManage();
		}

		public function datatables(){
			$draw = request('draw', 1);

			/*处理参数*/
			$wheres = [];

			$name = request('name', '');
			if($name){
			    // $query = $query->where($this->model->getPropName(), $name);
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

			$datas = $this->permissionRepo->datatables($wheres);

			$count = $this->permissionRepo->datatablesCount($wheres);

			return [
	            'draw' => $draw,
	            'recordsTotal' => $count,
	            'recordsFiltered' => $count,
	            'data' => $datas
	        ];
		}
	}