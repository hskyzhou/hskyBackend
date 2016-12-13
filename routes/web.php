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
$router->group(['namespace' => 'Backend', 'middleware' => ['auth', 'menu.permission']], function($router){
	$router->get('/', [
		'uses' => 'UserController@index',
		'as' => 'user.index'
	]);
	/*权限路由*/
	require(__DIR__ . '/backend/permissionRoute.php');
	
	/*角色*/
	require(__DIR__ . '/backend/roleRoute.php');

	/*用户*/
	require(__DIR__ . '/backend/userRoute.php');

	/*菜单*/
	require(__DIR__ . '/backend/menuRoute.php');
});

Auth::routes();