<?php 
	namespace App\Composers;

	use Illuminate\View\View;
	use App\Repositories\Eloquent\MenuRepositoryEloquent;

	class MenuComposer{
		protected $menuRepo;

		public function __construct(MenuRepositoryEloquent $menuRepo){
			$this->menuRepo = $menuRepo;
		}

		public function compose(View $view){
			$menus = collect([]);
			
			$view->with('menus', $menus);
		}
	}