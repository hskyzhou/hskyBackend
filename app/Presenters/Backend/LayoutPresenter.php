<?php
namespace App\Presenters\Backend;

use Exception;

class LayoutPresenter{
	public function showMenus($menus, $parentMenus, $currentMenu){
		$str = "";
		$menuStr = "";
		if(!$menus->isEmpty()){
			$this->dealMenus($menus, $parentMenus, $currentMenu, 1, $menuStr);
			$str .= $menuStr;
		}
		return $str;
	}

	/**
	 * 处理菜单
	 * @author hsky
	 * @date 12.4.2016
	 * @return string
	 * @param collection $menus
	 * @param int $level
	 * @param string $menuStr
	 */
	private function dealMenus($menus, $parentMenus, $currentMenu, $level, &$menuStr = ""){
		foreach($menus as $menu){
			$activeSonMenus = $menu->activeSonMenus;

			try {
				$url = $menu->route ? route($menu->route) : 'javascript::';
			} catch (Exception $e) {
				$url = '';
			}

			if($currentMenu && ($menu->id == $currentMenu->id || (isset($parentMenus[$currentMenu->id]) && in_array($menu->id, $parentMenus[$currentMenu->id])))){
				$menuStr .= '<li class="nav-item active open">';
			}else{
				$menuStr .= '<li class="nav-item">';
			}
			$menuStr .= '	<a href="'. $url .'" class="nav-link nav-toggle">';
			$menuStr .= '		<i class="icon-home"></i>';
			$menuStr .= '		<span class="title">'.$menu->title.'</span>';
			$menuStr .= '		<span class="selected"></span>';

			if(!$activeSonMenus->isEmpty()){
				if($currentMenu && ($menu->id == $currentMenu->id || (isset($parentMenus[$currentMenu->id]) && in_array($menu->id, $parentMenus[$currentMenu->id])))){
					$menuStr .= '		<span class="arrow open"></span>';
				}else{
					$menuStr .= '		<span class="arrow"></span>';
				}
			}
			$menuStr .= '	</a>';
			
			if(!$activeSonMenus->isEmpty()){
				$menuStr .= '<ul class="sub-menu">';
				$menuStr .= $this->dealMenus($activeSonMenus, $parentMenus, $currentMenu, $level+1);
				$menuStr .= '</ul>';
			}

			$menuStr .= '</li">';	
		}
		
		return $menuStr;
	}
}