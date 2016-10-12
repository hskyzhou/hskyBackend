<?php
	$router->group([], function($router){
		$router->resource('permission', 'PermissionController');
	});