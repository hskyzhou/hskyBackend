<?php 
Breadcrumbs::register('permission.index', function($breadcrumbs) {
    $breadcrumbs->push('首页', url('/'));
    $breadcrumbs->push('权限管理');
});

Breadcrumbs::register('permission.create', function($breadcrumbs) {
    $breadcrumbs->push('首页', url('/'));
    $breadcrumbs->push('权限管理', route('permission.index'));
    $breadcrumbs->push('添加权限');
});

Breadcrumbs::register('permission.edit', function($breadcrumbs) {
    $breadcrumbs->push('首页', url('/'));
    $breadcrumbs->push('权限管理', route('permission.index'));
    $breadcrumbs->push('修改权限');
});

