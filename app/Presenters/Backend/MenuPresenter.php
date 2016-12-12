<?php 

namespace App\Presenters\Backend;

class MenuPresenter{
	
	public function showMenus($menus, $menuRelations){
		$str = "";
		$menuStr = "";
		$url = route('menu.sort');
		if(!$menus->isEmpty()){
			$str .= '<div class="dd" id="nestable_list_3" data-url="'.route('menu.sort').'">';
            $str .= '	<ol class="dd-list">';
			$this->dealMenus($menus, 1, $menuRelations, $menuStr);
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
	private function dealMenus($menus, $level, $menuRelations, &$menuStr = ""){
		foreach($menus as $menu){
			$menuStr .= '<li class="dd-item dd3-item" data-id="'.$menu->id.'">';	
			$menuStr .= '<div class="dd-handle dd3-handle"> </div>';
			$menuStr .= '<div class="dd3-content">';
			if($menu->status == getStatusClose()){
				$menuStr .= '		<span class="font-grey-silver">'.$menu->title.'</span>';
			}else{
				$menuStr .= '		<span>'.$menu->title.'</span>';				
			}
			$menuStr .= '	<div class="pull-right">';
			if($level == 1){
		        $menuStr .= '		<a href="'.route('menu.create', ['id' => $menu->id]).'" class="addMenu" data-target="#ajax" data-toggle="modal"><span class="fa fa-plus"></span></a>';
			}
	        $menuStr .= '		<a href="'.route('menu.edit', ['id' => $menu->id]).'" class="editMenu" data-target="#ajax" data-toggle="modal"><span class="fa fa-pencil"></span></a>';
	        $menuStr .= '		<a data-url="'.route('menu.destroy', [$menu->id]).'" class="deleteMenu"><span class="fa fa-trash"></span></a>';
			$menuStr .= '	</div>';
			$menuStr .= '</div>';

			if(!$menu->sonMenus->isEmpty()){
				$menuStr .= '<ol class="dd-list">';
				$menuStr .= $this->dealMenus($menu->sonMenus, $level+1, $menuRelations);
				$menuStr .= '</ol>';
			}
			$menuStr .= '</li">';	
		}
		
		return $menuStr;
	}
}