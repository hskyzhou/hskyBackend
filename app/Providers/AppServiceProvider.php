<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Composers\MenuComposer;
use App\Composers\ThemeComposer;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*菜单composer*/
        view()->composer('themes.*.sidebar', MenuComposer::class);
        view()->composer('*', ThemeComposer::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
