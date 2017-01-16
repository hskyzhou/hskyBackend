<?php 

Breadcrumbs::register('log-viewer::dashboard', function($breadcrumbs) {
    $breadcrumbs->push(trans('backend.index'), url('/'));
    $breadcrumbs->push(trans('backend.log.dashboard'));
});

Breadcrumbs::register('log-viewer::logs.list', function($breadcrumbs) {
    $breadcrumbs->push(trans('backend.index'), url('/'));
    $breadcrumbs->push(trans('backend.log.list'));
});

Breadcrumbs::register('log-viewer::logs.show', function($breadcrumbs) {
    $breadcrumbs->push(trans('backend.index'), url('/'));
    $breadcrumbs->push(trans('backend.log.list'), route('log-viewer::logs.list'));
    $breadcrumbs->push(trans('backend.log.detail'));
});

Breadcrumbs::register('log-viewer::logs.filter', function($breadcrumbs) {
    $breadcrumbs->push(trans('backend.index'), url('/'));
    $breadcrumbs->push(trans('backend.log.list'), route('log-viewer::logs.list'));
    $breadcrumbs->push(trans('backend.log.filter'));
});

