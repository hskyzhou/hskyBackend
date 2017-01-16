<?php 

Breadcrumbs::register('menu.index', function($breadcrumbs) {
    $breadcrumbs->push(trans('backend.index'), url('/'));
    $breadcrumbs->push(trans('backend.menu.list'));
});