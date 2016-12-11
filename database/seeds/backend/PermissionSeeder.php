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
        ];

        Permission::insert($data);
    }
}
