# hsky backend for laravel

1. laravel version : 5.3

1. 安装
	1. `php artisan key:generate` 生成key
	1. `composer install` 安装项目所需要的包
	1. `复制 .env.example  到 .env` 修改.env中配置
	
2. 完成
	1. [完成]语言包
	1. [完成]面包屑(breadcrumb)
		使用包: "davejamesmiller/laravel-breadcrumbs": "^3.0"
	1. [完成]权限管理
	1. [完成]用户管理
	1. [完成]角色管理
	1. [完成]菜单管理
		[完成]菜单中间件，自动判断访问菜单所需权限以及该权限的前置权限
		[完成]菜单高亮 使用包laravelista/Ekko， 配置是menus表中high_uri