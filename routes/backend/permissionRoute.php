<?php
	$router->group([], function($router){

		$router->group(['as' => 'permission.'], function($router){
			$router->post('datatables', [
				'uses' => 'PermissionController@datatables',
				'as' => 'datatables'
			]);

			$router->post('delete/{id}', [
				'uses' => 'PermissionController@delete',
				'as' => 'delete',
			]);

			$router->post('restore/{id}', [
				'uses' => 'PermissionController@restore',
				'as' => 'restore',
			]);

			/*恢复多个*/
			$router->post('restoremore', [
				'uses' => 'PermissionController@restoreMore',
				'as' => 'restore.more'
			]);

			/*删除多个*/
			$router->post('deletemore', [
				'uses' => 'PermissionController@deleteMore',
				'as' => 'delete.more'
			]);

			/*彻底删除多个*/
			$router->post('destroymore', [
				'uses' => 'PermissionController@destroyMore',
				'as' => 'destroy.more'
			]);
		});

		$router->resource('permission', 'PermissionController');
	});