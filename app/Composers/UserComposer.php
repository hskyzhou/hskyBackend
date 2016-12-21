<?php 
	namespace App\Composers;

	use Illuminate\View\View;

	use App\Traits\ControllerTrait;

	class UserComposer{
		use ControllerTrait;
		public function compose(View $view){
			$view->with('user', auth()->user());
		}
	}