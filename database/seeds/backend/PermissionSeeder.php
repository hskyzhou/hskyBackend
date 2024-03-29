<?php

use Illuminate\Database\Seeder;

use App\Repositories\Models\Permission;
use Carbon\Carbon;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
    	$created_at = (new Carbon())->toDateString();
    	$updated_at = (new Carbon())->toDateString();
    	$model = 'App\Repositories\Models\Permission';
        $data = [
        	[
        		'name' => '系统管理',
        		'slug' => 'system.manage',
        		'description' => '权限管理',
        		'model' => $model,
        		'position' => 'module',
        		'created_at' => $created_at,
        		'updated_at' => $updated_at
        	],
        	[
        		'name' => '权限管理',
        		'slug' => 'permission.manage',
        		'description' => '权限管理',
        		'model' => $model,
        		'position' => 'module',
        		'created_at' => $created_at,
        		'updated_at' => $updated_at
        	],
        	[
        		'name' => '角色管理',
        		'slug' => 'role.manage',
        		'description' => '角色管理',
        		'model' => $model,
        		'position' => 'module',
        		'created_at' => $created_at,
        		'updated_at' => $updated_at
        	],
        	[
        		'name' => '用户管理',
        		'slug' => 'user.manage',
        		'description' => '用户管理',
        		'model' => $model,
        		'position' => 'module',
        		'created_at' => $created_at,
        		'updated_at' => $updated_at
        	],
        	[
        		'name' => '菜单管理',
        		'slug' => 'menu.manage',
        		'description' => '菜单管理',
        		'model' => $model,
        		'position' => 'module',
        		'created_at' => $created_at,
        		'updated_at' => $updated_at
        	],
            [
                'name' => '日志管理',
                'slug' => 'log.manage',
                'description' => '日志管理',
                'model' => $model,
                'position' => 'module',
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ],
            [
                'name' => '系统日志',
                'slug' => 'log.system.manage',
                'description' => '系统日志',
                'model' => $model,
                'position' => 'module',
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ],
            [
                'name' => '日志总览',
                'slug' => 'log.system.index',
                'description' => '日志总览',
                'model' => $model,
                'position' => 'module',
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ],
            [
                'name' => '日志列表',
                'slug' => 'log.system.list',
                'description' => '日志列表',
                'model' => $model,
                'position' => 'module',
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ],
            [
                'name' => '日志详情',
                'slug' => 'log.system.detail',
                'description' => '日志详情',
                'model' => $model,
                'position' => 'module',
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ],
            [
                'name' => '日志过滤',
                'slug' => 'log.system.filter',
                'description' => '日志过滤',
                'model' => $model,
                'position' => 'module',
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ],
        ];

        Permission::insert($data);
    }
}
