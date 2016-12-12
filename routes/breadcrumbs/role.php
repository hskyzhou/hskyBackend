<?php 

Breadcrumbs::register('role.index', function($breadcrumbs) {
    $breadcrumbs->push('首页', url('/'));
    $breadcrumbs->push('角色管理');
});

Breadcrumbs::register('role.create', function($breadcrumbs) {
    $breadcrumbs->push('首页', url('/'));
    $breadcrumbs->push('角色管理', route('role.index'));
    $breadcrumbs->push('添加角色');
});

Breadcrumbs::register('role.edit', function($breadcrumbs) {
    $breadcrumbs->push('Index', url('/'));
    $breadcrumbs->push('角色管理', route('role.index'));
    $breadcrumbs->push('修改角色');
});