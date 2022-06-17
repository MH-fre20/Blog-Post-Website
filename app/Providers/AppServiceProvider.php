<?php

namespace App\Providers;

use App\Http\ViewCompoer\ActivityComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\blade;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\PostController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::aliasComponent('components.tags', 'tags');

        View::composer('posts.show', 'App\Http\ViewComposer\ActivityComposer');
        View::composer('posts.index', 'App\Http\ViewComposer\ActivityComposer');
    }
}
