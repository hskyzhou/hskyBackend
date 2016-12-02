<?php

$router->group([], function($router){

	$router->group(['prefix' => 'user', 'as' => 'user.'], function($router){
		$router->post('datatables', [
			'uses' => 'UserController@datatables',
			'as' => 'datatables'
		]);

		$router->post('delete/{id}', [
			'uses' => 'UserController@delete',
			'as' => 'delete'
		]);

		$router->post('restore/{id}', [
			'uses' => 'UserController@restore',
			'as' => 'restore'
		]);

		$router->post('deletemore/', [
			'uses' => 'UserController@deleteMore',
			'as' => 'delete.more'
		]);

		$router->post('restoremore', [
			'uses' => 'UserController@restoreMore',
			'as' => 'restore.more'
		]);

		$router->post('destroymore', [
			'uses' => 'UserController@destroyMore',
			'as' => 'destroy.more'
		]);
	});

	$router->resource('user', 'UserController');
});