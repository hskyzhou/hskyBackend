<?php 

Breadcrumbs::register('user.index', function($breadcrumbs) {
    $breadcrumbs->push('首页', url('/'));
    $breadcrumbs->push('用户列表');
});

Breadcrumbs::register('user.create', function($breadcrumbs) {
    $breadcrumbs->push('首页', url('/'));
    $breadcrumbs->push('用户列表', route('user.index'));
    $breadcrumbs->push('添加用户');
});

Breadcrumbs::register('user.edit', function($breadcrumbs) {
    $breadcrumbs->push('首页', url('/'));
    $breadcrumbs->push('用户列表', route('user.index'));
    $breadcrumbs->push('修改用户');
});