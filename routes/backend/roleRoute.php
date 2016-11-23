<?php

$router->group([], function($router){
	$router->group(['as' => 'role.'], function($router){

	});

	$router->resource('role', 'RoleController');
});