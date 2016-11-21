<?php 
	if(!function_exists('getStatusOpen')){
		/*获取 开启状态的值*/
		function getStatusActive(){
			return config('global.status.active.value');
		}
	}

	if(!function_exists('getStatusClose')){
		/*获取 关闭状态的值*/
		function getStatusClose(){
			return config('global.status.close.value');
		}
	}