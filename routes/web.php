<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*后台功能*/
$router->group(['namespace' => 'Backend', 'middleware' => ['menu.permission']], function($router){
	// 权限路由
	require(__DIR__ . '/backend/permissionRoute.php');
});