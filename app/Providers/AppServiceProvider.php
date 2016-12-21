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

        // \App\User::saving(function($query){
        //     dd($query);
        // });

        // \Event::listen('eloquent.saved:*', function($a){
        //     // dd($a);
        // });
        

        // \Event::listen('eloquent.saving:*', function($query){
        //     // dd($query);
        //     $db = app('db');
        //     $queryCollector = '';
        //     app('db')->listen(
        //         function ($query, $bindings = null, $time = null, $connectionName = null) use ($db, $queryCollector){
        //             dd($query);
        //             // dd($query, $bindings, $time, $connectionName);
        //             // Laravel 5.2 changed the way some core events worked. We must account for
        //             // the first argument being an "event object", where arguments are passed
        //             // via object properties, instead of individual arguments.
        //             if ( $query instanceof \Illuminate\Database\Events\QueryExecuted ) {
        //                 $bindings = $query->bindings;
        //                 $time = $query->time;
        //                 $connection = $query->connection;

        //                 $query = $query->sql;
        //             } else {
        //                 $connection = $db->connection($connectionName);
        //             }

        //             dd($connection->compileUpdate());

        //             dd($connection->prepareBindings($bindings));
        //         });
            
        // });
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
