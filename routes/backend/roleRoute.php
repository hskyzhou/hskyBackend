<?php

$router->group([], function($router){
	$router->group(['as' => 'role.'], function($router){
		$router->post('datatables', [
			'uses' => 'RoleController@datatables',
			'as' => 'datatables'
		]);
	});

	$router->resource('role', 'RoleController');
});