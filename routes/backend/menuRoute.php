<?php

$router->group([], function($router){

	$router->group(['prefix' => 'menu', 'as' => 'menu.'], function($router){
		$router->post('datatables', [
			'uses' => 'MenuController@datatables',
			'as' => 'datatables'
		]);

		$router->post('delete/{id}', [
			'uses' => 'MenuController@delete',
			'as' => 'delete'
		]);

		$router->post('restore/{id}', [
			'uses' => 'MenuController@restore',
			'as' => 'restore'
		]);

		$router->post('deletemore/', [
			'uses' => 'MenuController@deleteMore',
			'as' => 'delete.more'
		]);

		$router->post('restoremore', [
			'uses' => 'MenuController@restoreMore',
			'as' => 'restore.more'
		]);

		$router->post('destroymore', [
			'uses' => 'MenuController@destroyMore',
			'as' => 'destroy.more'
		]);
	});

	$router->resource('menu', 'MenuController');
});