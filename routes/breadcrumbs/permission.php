<?php 
Breadcrumbs::register('permission.index', function($breadcrumbs) {
    $breadcrumbs->push(trans('backend.index'), url('/'));
    $breadcrumbs->push(trans('backend.permission.list'));
});

Breadcrumbs::register('permission.create', function($breadcrumbs) {
    $breadcrumbs->push(trans('backend.index'), url('/'));
    $breadcrumbs->push(trans('backend.permission.list'), route('permission.index'));
    $breadcrumbs->push(trans('backend.permission.create'));
});

Breadcrumbs::register('permission.edit', function($breadcrumbs) {
    $breadcrumbs->push(trans('backend.index'), url('/'));
    $breadcrumbs->push(trans('backend.permission.list'), route('permission.index'));
    $breadcrumbs->push(trans('backend.permission.update'));
});

