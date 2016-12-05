<?php 

namespace App\Presenters\Backend;

class MenuPresenter{
	
	public function showMenus($menus){
		$str = "";
		$menuStr = "";
		if(!$menus->isEmpty()){
			$str .= '<div class="dd" id="nestable_list_3">';
            $str .= '	<ol class="dd-list">';
			$this->dealMenus($menus, 1, $menuStr);
			$str .= $menuStr;
			$str .= '	</ol>';
			$str .= '</div>';
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
			$menuStr .= '<li class="dd-item dd3-item" data-id="'.$menu->id.'">';	
			$menuStr .= '<div class="dd-handle dd3-handle"> </div>';
			$menuStr .= '<div class="dd3-content">';
			$menuStr .= '		<span>'.$menu->title.'</span>';
			$menuStr .= '	<div class="pull-right">';
			if($level == 1){
		        $menuStr .= '		<a href="'.route('menu.create', ['id' => $menu->id]).'" class="addMenu" data-target="#ajax" data-toggle="modal"><span class="fa fa-plus"></span></a>';
			}
	        $menuStr .= '		<a class="editMenu"><span class="fa fa-pencil"></span></a>';
	        $menuStr .= '		<a class="deleteMenu"><span class="fa fa-trash"></span></a>';
			$menuStr .= '	</div>';
			$menuStr .= '</div>';

			if(!$menu->sonMenus->isEmpty()){
				$menuStr .= '<ol class="dd-list">';
				$menuStr .= $this->dealMenus($menu->sonMenus, $level+1);
				$menuStr .= '</ol>';
			}
			$menuStr .= '</li">';	
		}
		
		return $menuStr;
	}
}