<?php 
	namespace App\Composers;

	use Illuminate\View\View;
	use App\Repositories\Eloquent\MenuRepositoryEloquent;
	use App\Repositories\Eloquent\MenuRelationRepositoryEloquent;
	use App\Repositories\Eloquent\PermissionRepositoryEloquent;

	use App\Repositories\Criteria\OrderBySortAscCriteria;
	use App\Repositories\Criteria\StatusActiveCriteria;

	class MenuComposer{
		protected $menuRepo;
		protected $menuRelationRepo;
		protected $permissionRepo;

		public function __construct(
			MenuRepositoryEloquent $menuRepo,
			MenuRelationRepositoryEloquent $menuRelationRepo,
			PermissionRepositoryEloquent $permissionRepo
		){
			$this->menuRepo = $menuRepo;
			$this->menuRelationRepo = $menuRelationRepo;
			$this->permissionRepo = $permissionRepo;
		}

		public function compose(View $view){
			$userPermissions = $this->permissionRepo->userPermissions()->keys();

			$menuRelations = $this->menuRelationRepo->all()->keyBy('menu_id')->keys();

			$this->menuRepo->pushCriteria(OrderBySortAscCriteria::class);
			$this->menuRepo->pushCriteria(StatusActiveCriteria::class);
			$menus = $this->menuRepo->with(['activeSonMenus', 'permission'])->all()->filter(function($item, $key) use ($menuRelations, $userPermissions){
				if($item->permission){
					if($userPermissions->contains($item->permission->id)){
						if(!$menuRelations->contains($item->id)){
							return true;
						}

					 	if(!$item->activeSonMenus->isEmpty() && !$menuRelations->contains($item->id)){
						 	return true;
					 	}
					}
				}else{
					if(!$menuRelations->contains($item->id)){
						return true;
					}
				}
			});

			$view->with('menus', $menus);
		}
	}