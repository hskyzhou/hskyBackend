<?php 
	namespace App\Traits;

	use Route;

	Trait ControllerTrait{
		
		/*获取项目主题*/
		public function getTheme(){
			return config('global.theme');
		}

		/*获取项目模板文件夹*/
		public function getModule(){
			$moduleName = '';

			$actionName = Route::current()->getActionName();

			$lastActionName = class_basename($actionName);  //获取controller@method

			if(str_contains($lastActionName, '@')){
				list($actionControllerName, $actionMethodName) = explode('@', $lastActionName);
				$moduleName = strtolower(str_replace('Controller', '', $actionControllerName)) . '.';
			}

			return $moduleName;
		}
	}