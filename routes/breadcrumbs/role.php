<?php 

Breadcrumbs::register('role.index', function($breadcrumbs) {
    $breadcrumbs->push(trans('backend.index'), url('/'));
    $breadcrumbs->push(trans('backend.role.list'));
});

Breadcrumbs::register('role.create', function($breadcrumbs) {
    $breadcrumbs->push(trans('backend.index'), url('/'));
    $breadcrumbs->push(trans('backend.role.list'), route('role.index'));
    $breadcrumbs->push(trans('backend.role.create'));
});

Breadcrumbs::register('role.edit', function($breadcrumbs) {
    $breadcrumbs->push(trans('backend.index'), url('/'));
    $breadcrumbs->push(trans('backend.role.list'), route('role.index'));
    $breadcrumbs->push(trans('backend.role.update'));
});