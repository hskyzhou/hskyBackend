<?php

use Illuminate\Database\Seeder;

use App\Repositories\Models\Menu;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created_at = (new Carbon())->toDateString();
        $updated_at = (new Carbon())->toDateString();
        $data = [
        	[
        		'title' => '系统管理',
        		'slug' => 'system.manage',
        		'route' => '',
        		'uri' => '',
        		'status' => 1,
        		'desc' => '系统管理',
        		'sort' => 0,
        		'icon' => 'fa fa-cloud',
        		'created_at' => $created_at,
        		'updated_at' => $updated_at,
        	],
        	[
        		'title' => '权限管理',
        		'slug' => 'permission.manage',
        		'route' => 'permission.index',
        		'uri' => 'permission',
        		'status' => 1,
        		'desc' => '权限管理',
        		'sort' => 0,
        		'icon' => 'fa fa-cloud',
        		'created_at' => $created_at,
        		'updated_at' => $updated_at,
        	],
        	[
        		'title' => '角色管理',
        		'slug' => 'role.manage',
        		'route' => 'role.index',
        		'uri' => 'role',
        		'status' => 1,
        		'desc' => '角色管理',
        		'sort' => 0,
        		'icon' => 'fa fa-cloud',
        		'created_at' => $created_at,
        		'updated_at' => $updated_at,
        	],
        	[
        		'title' => '用户管理',
        		'slug' => 'user.manage',
        		'route' => 'user.index',
        		'uri' => 'user',
        		'status' => 1,
        		'desc' => '用户管理',
        		'sort' => 0,
        		'icon' => 'fa fa-cloud',
        		'created_at' => $created_at,
        		'updated_at' => $updated_at,
        	],
        	[
        		'title' => '菜单管理',
        		'slug' => 'menu.manage',
        		'route' => 'menu.index',
        		'uri' => 'menu',
        		'status' => 1,
        		'desc' => '菜单管理',
        		'sort' => 0,
        		'icon' => 'fa fa-cloud',
        		'created_at' => $created_at,
        		'updated_at' => $updated_at,
        	],
            [
                'title' => '日志管理',
                'slug' => 'log.manage',
                'route' => '',
                'uri' => '',
                'status' => 1,
                'desc' => '日志管理',
                'sort' => 0,
                'icon' => 'fa fa-cloud',
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ],
            [
                'title' => '系统日志',
                'slug' => 'log.system.manage',
                'route' => '',
                'uri' => '',
                'status' => 1,
                'desc' => '系统日志',
                'sort' => 0,
                'icon' => 'fa fa-cloud',
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ],
            [
                'title' => '日志总览',
                'slug' => 'log.system.index',
                'route' => 'log-viewer::dashboard',
                'uri' => '',
                'status' => 1,
                'desc' => '日志总览',
                'sort' => 0,
                'icon' => 'fa fa-cloud',
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ],
            [
                'title' => '日志列表',
                'slug' => 'log.system.list',
                'route' => 'log-viewer::logs.list',
                'uri' => '',
                'status' => 1,
                'desc' => '日志列表',
                'sort' => 0,
                'icon' => 'fa fa-cloud',
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]
        ];

        Menu::insert($data);
    }
}
