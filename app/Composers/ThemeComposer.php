<?php 
	namespace App\Composers;

	use Illuminate\View\View;

	use App\Traits\ControllerTrait;

	class ThemeComposer{
		use ControllerTrait;
		public function compose(View $view){
			
			$view->with('theme', $this->getTheme());
		}
	}