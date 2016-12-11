<?php
namespace App\Presenters\Backend;

class LayoutPresenter{
	public function showMenus($menus){
		$str = "";
		$menuStr = "";
		if(!$menus->isEmpty()){
			$this->dealMenus($menus, 1, $menuStr);
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
	private function dealMenus($menus, $level, &$menuStr = ""){
		foreach($menus as $menu){

			$menuStr .= '<li class="nav-item start">';
			$menuStr .= '	<a href="javascript:;" class="nav-link nav-toggle">';
			$menuStr .= '		<i class="icon-home"></i>';
			$menuStr .= '		<span class="title">系统管理</span>';
			$menuStr .= '		<span class="selected"></span>';
			$menuStr .= '		<span class="arrow"></span>';
			$menuStr .= '	</a>';

			if(!$menu->sonMenus->isEmpty()){
				$menuStr .= '<ul class="sub-menu">';
				$menuStr .= $this->dealMenus($menu->sonMenus, $level+1);
				$menuStr .= '</ul>';
			}

			$menuStr .= '</li">';	
		}
		
		return $menuStr;
	}
}