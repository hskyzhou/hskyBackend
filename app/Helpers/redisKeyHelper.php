<?php

if(!function_exists('globalRedisKey')){
	function globalRedisKey(){
		return config('global.redisKey', 'web:');
	}
}

/*用户权限redis key*/
if(!function_exists('userPermissionRedisKey')){
	function userPermissionRedisKey($userId){
		return globalRedisKey() . "user:{$userId}:permission";
	}
}

/*菜单权限redis key*/
if(!function_exists('menuPermissionRedisKey')){
	function menuPermissionRedisKey($menuId){
		return globalRedisKey() . "menu:{$menuId}:permission";
	}
}

/*所有权限*/
if(!function_exists('permissionRedisKey')){
	function permissionRedisKey(){
		return globalRedisKey() . "permission";
	}
}