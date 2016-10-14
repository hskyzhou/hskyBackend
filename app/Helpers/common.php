<?php 
	if(!function_exists('getUser')){
		function getUser($user = ''){
			return $user ? $user : auth()->user();
		}
	}