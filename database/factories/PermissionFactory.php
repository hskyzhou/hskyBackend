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

$factory->define(App\Entities\Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'slug' => $faker->word,
        'description' => $faker->text,
        'model' => '',
        'position' => 'page',	//权限位置,module-控制进入页面,page-控制页面中按钮,查询等
    ];
});


$factory->state(App\Entities\Permission::class, 'page', function (Faker\Generator $faker) {
    return [
        'position' => 'page',
    ];
});


$factory->state(App\Entities\Permission::class, 'module', function (Faker\Generator $faker) {
    return [
        'position' => 'module',
    ];
});