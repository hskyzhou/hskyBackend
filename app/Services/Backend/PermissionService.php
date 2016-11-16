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
	}