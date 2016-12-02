<?php
namespace App\Presenters\Backend;

class UserPresenter{

	public function showRoles($roles, $user = ''){
		$str = "";

		if(!$roles->isEmpty()){
			foreach($roles as $role){
				if($user && $user->roles->contains($role->id)){
					$str .= "<option value='".$role->id."' selected>".$role->name."</option>";
				}else{
					$str .= "<option value='".$role->id."'>".$role->name."</option>";
				}
			}			
		}
		return $str;
	}

	public function showPermissions($permissions, $user = ''){
		$str = "";
		foreach($permissions as $key => $permission){
			$str .= "<tr>";
			$str .= "	<td>{$key}</td>";
            $str .= "	<td>";
            if(is_array($permission)){
            	foreach($permission as $key => $val){
            		if($user && $user->userPermissions->contains($val['id'])){
						$str .= "<input type='checkbox' class='group-checkable' name='permission[]' value='{$val['id']}' checked >{$val['name']}";
            		}else{
						$str .= "<input type='checkbox' class='group-checkable' name='permission[]' value='{$val['id']}'>{$val['name']}";
            		}

					if(!$val['childs']->isEmpty()){
						$prePermissions = "";
						foreach($val['childs'] as $child){
							$prePermissions .= $child->name . "<br />";
						}
						$str .= "<a class='tooltips' data-html='true' data-container='body' data-placement='left' data-original-title='{$prePermissions}'>(前)</a>";
					}
				}
			}
			$str .= "	</td>";
			$str .= "</tr>";
		}
		return $str;
		
	}
}