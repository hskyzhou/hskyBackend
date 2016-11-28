<?php

$router->group([], function($router){
	$router->group(['as' => 'role.'], function($router){
		$router->post('datatables', [
			'uses' => 'RoleController@datatables',
			'as' => 'datatables'
		]);

		$router->post('delete/{id}', [
			'uses' => 'RoleController@delete',
			'as' => 'delete'
		]);

		$router->post('restore', [
			'uses' => 'RoleController@restore',
			'as' => 'restore'
		]);

	});

	$router->resource('role', 'RoleController');
});