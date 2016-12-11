<?php 

Breadcrumbs::register('log-viewer::dashboard', function($breadcrumbs) {
    $breadcrumbs->push('Index', url('/'));
    $breadcrumbs->push('系统日志', route('log-viewer::dashboard'));
    $breadcrumbs->push('日志列表', route('log-viewer::logs.list'));
});

Breadcrumbs::register('log-viewer::logs.list', function($breadcrumbs) {
    $breadcrumbs->push('Index', url('/'));
    $breadcrumbs->push('系统日志', route('log-viewer::dashboard'));
    $breadcrumbs->push('日志列表', route('log-viewer::logs.list'));
});

Breadcrumbs::register('log-viewer::logs.show', function($breadcrumbs) {
    $breadcrumbs->push('Index', url('/'));
    $breadcrumbs->push('系统日志', route('log-viewer::dashboard'));
    $breadcrumbs->push('日志列表', route('log-viewer::logs.list'));
});

Breadcrumbs::register('log-viewer::logs.filter', function($breadcrumbs) {
    $breadcrumbs->push('Index', url('/'));
    $breadcrumbs->push('系统日志', route('log-viewer::dashboard'));
    $breadcrumbs->push('日志列表', route('log-viewer::logs.list'));
});

