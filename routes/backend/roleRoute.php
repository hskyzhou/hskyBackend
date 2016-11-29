<?php

$router->group([], function($router){

	$router->group(['prefix' => 'role', 'as' => 'role.'], function($router){
		$router->post('datatables', [
			'uses' => 'RoleController@datatables',
			'as' => 'datatables'
		]);

		$router->post('delete/{id}', [
			'uses' => 'RoleController@delete',
			'as' => 'delete'
		]);

		$router->post('restore/{id}', [
			'uses' => 'RoleController@restore',
			'as' => 'restore'
		]);

		$router->post('deletemore/', [
			'uses' => 'RoleController@deleteMore',
			'as' => 'delete.more'
		]);

		$router->post('restoremore', [
			'uses' => 'RoleController@restoreMore',
			'as' => 'restore.more'
		]);

		$router->post('destroymore', [
			'uses' => 'RoleController@destroyMore',
			'as' => 'destroy.more'
		]);
	});

	$router->resource('role', 'RoleController');
});