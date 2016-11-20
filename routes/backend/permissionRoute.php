<?php
	$router->group([], function($router){

		$router->group(['as' => 'permission.'], function($router){
			$router->post('datatables', [
				'uses' => 'PermissionController@datatables',
				'as' => 'datatables'
			]);
		});

		$router->resource('permission', 'PermissionController');
	});