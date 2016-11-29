<?php
	namespace App\Presenters\Backend;

	class PermissionPresenter{
		public function permissionsManage($permissionsManage){
			/*权限数据*/
			$permissionData = $permissionsManage['data'];
			/*权限关系*/
			$permissionRelation = $permissionsManage['relation'];

			/*返回字符串*/
			$str = '';

			if($permissionData){
				foreach($permissionData as $permissionKey => $permissionInfo){
					$name = isset($permissionRelation[$permissionKey]) ? $permissionRelation[$permissionKey] : $permissionKey;
			        $str .= '<li class="dd-item dd3-item" data-id="1">';
			        $str .= '    <div class="dd-handle dd3-handle"></div>';
			        $str .= '    <div class="dd3-content"> ';
			        $str .= '    	<span class="content-class">'. $name .'</span>';
					$str .= '			<div class="pull-right actions">';
					$str .= '				<a class="btn btn-xs green" style="padding:0 0; margin-bottom: 7px;"><i class="fa fa-plus"></i></a>';
					$str .= '				<a class="btn btn-xs red" style="padding:0 0; margin-bottom: 7px;"><i class="fa fa-times"></i></a>';
					$str .= '			</div>';
			        $str .= '    </div>';
			        if($permissionInfo){
				        $str .= '	 <ol class="dd-list">';
			        	foreach($permissionInfo as $permissionValKey => $permissionVal){
					        $str .= '    	<li class="dd-item dd3-item" data-id="3">';
					        $str .= '       	<div class="dd-handle dd3-handle"></div>';
					        $str .= '        	<div class="dd3-content">';
					        
					        $str .= '			</div>';
					        $str .= '    	</li>';
			        	}
				        $str .= '	 </ol>';
			        }
			        $str .= '</li>';
				}
			}

			return $str;
		}
	}