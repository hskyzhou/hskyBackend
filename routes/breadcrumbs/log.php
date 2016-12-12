<?php 

Breadcrumbs::register('log-viewer::dashboard', function($breadcrumbs) {
    $breadcrumbs->push('首页', url('/'));
    $breadcrumbs->push('日志总览');
});

Breadcrumbs::register('log-viewer::logs.list', function($breadcrumbs) {
    $breadcrumbs->push('首页', url('/'));
    $breadcrumbs->push('日志列表');
});

Breadcrumbs::register('log-viewer::logs.show', function($breadcrumbs) {
    $breadcrumbs->push('首页', url('/'));
    $breadcrumbs->push('日志列表', route('log-viewer::logs.list'));
    $breadcrumbs->push('日志详情');
});

Breadcrumbs::register('log-viewer::logs.filter', function($breadcrumbs) {
    $breadcrumbs->push('首页', url('/'));
    $breadcrumbs->push('日志列表', route('log-viewer::logs.list'));
    $breadcrumbs->push('日志过滤');
});

