<?php 

Breadcrumbs::register('user.index', function($breadcrumbs) {
    $breadcrumbs->push(trans('backend.index'), url('/'));
    $breadcrumbs->push(trans('backend.user.list'));
});

Breadcrumbs::register('user.create', function($breadcrumbs) {
    $breadcrumbs->push(trans('backend.index'), url('/'));
    $breadcrumbs->push(trans('backend.user.list'), route('user.index'));
    $breadcrumbs->push(trans('backend.user.create'));
});

Breadcrumbs::register('user.edit', function($breadcrumbs) {
    $breadcrumbs->push(trans('backend.index'), url('/'));
    $breadcrumbs->push(trans('backend.user.list'), route('user.index'));
    $breadcrumbs->push(trans('backend.user.update'));
});