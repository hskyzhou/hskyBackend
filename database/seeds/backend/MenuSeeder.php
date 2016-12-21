<?php

use Illuminate\Database\Seeder;

use App\Repositories\Models\Menu;
use App\Repositories\Models\MenuRelation;
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
                'high_uri' => "permission.*,role.*,user.*,menu.*,log-viewer::*,log-viewer::logs.*",
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
                'high_uri' => 'permission.*',
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
                'high_uri' => 'role.*',
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
                'high_uri' => 'user.*',
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
                'high_uri' => 'menu.*',
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
                'high_uri' => 'log-viewer::*,log-viewer::logs.*',
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
                'high_uri' => 'log-viewer::*,log-viewer::logs.*',
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
                'high_uri' => 'log-viewer::dashboard',
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
                'high_uri' => 'log-viewer::logs.*',
                'status' => 1,
                'desc' => '日志列表',
                'sort' => 0,
                'icon' => 'fa fa-cloud',
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ],
        ];

        Menu::insert($data);

        $menuRelationData = [
            [
                'menu_id' => 2,
                'parent_menu_id' => 1,
                'sort' => 0,
            ],
            [
                'menu_id' => 3,
                'parent_menu_id' => 1,
                'sort' => 1,
            ],
            [
                'menu_id' => 4,
                'parent_menu_id' => 1,
                'sort' => 2,
            ],
            [
                'menu_id' => 5,
                'parent_menu_id' => 1,
                'sort' => 3,
            ],
            [
                'menu_id' => 6,
                'parent_menu_id' => 1,
                'sort' => 4,
            ],
            [
                'menu_id' => 7,
                'parent_menu_id' => 6,
                'sort' => 0,
            ],
            [
                'menu_id' => 8,
                'parent_menu_id' => 7,
                'sort' => 0,
            ],
            [
                'menu_id' => 9,
                'parent_menu_id' => 7,
                'sort' => 1,
            ]
        ];
        MenuRelation::insert($menuRelationData);
    }
}
