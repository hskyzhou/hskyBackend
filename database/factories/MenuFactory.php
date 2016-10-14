<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Entities\Menu::class, function (Faker\Generator $faker) {

    

    return [
        'title' => $faker->name,	//菜单标题
        'slug' =>  function(){
            $permissions = App\Entities\Permission::all();

            $permission = $permissions->random();
            return $permission->slug;
        },	//访问菜单对应权限的slug
        'route' => $faker->name,	//菜单对应的路由名称
        'uri' => $faker->word,	//菜单的uri地址
        'status' => 1,	//1-开启, 2-关闭
        'desc' => '',	//描述
        'sort' => $faker->randomDigit,	//排序
        'icon' => 'fa fa-cloud',	//图标
    ];
});