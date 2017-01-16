<?php 
return [
	'action' => 'action',
	'created_at' => 'created_at',
	'status' => [
		'open' => 'open',
		'close' => 'close',
	],

	'user' => [
		'name' => 'name',
		'email' => 'email',
		'password' => 'password',
		'status' => 'status',
		'role' => 'role',
		'permission' => 'permission',
	],

	'permission' => [
		'name' => 'name',
		'slug' => 'slug',
		'description' => 'description',
		'position' => 'position',
		'module' => 'module',
		'status' => 'status',
		'permission' => 'permission',
		'model' => 'model',
	],

	'role' => [
		'name' => 'name',
		'slug' => 'slug',
		'description' => 'description',
		'level' => 'level',
		'status' => 'status',
		'permission' => 'permission'
	],
];