<?php 

Breadcrumbs::register('menu.index', function($breadcrumbs) {
    $breadcrumbs->push('首页', url('/'));
    $breadcrumbs->push('菜单管理');
});