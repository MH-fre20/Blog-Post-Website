<?php

namespace App\Providers;

use App\Http\ViewCompoer\ActivityComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\blade;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        DB::listen(function($query) {
            Log::info(
                $query->sql,
                $query->bindings
            );
        });

        Blade::aliasComponent('components.tags', 'tags');
        Blade::aliasComponent('components.comment-form', 'commentForm');
        Blade::aliasComponent('components.comment-list', 'commentList');
        
        View::composer('posts.show', 'App\Http\ViewComposer\ActivityComposer');
        View::composer('posts.index', 'App\Http\ViewComposer\ActivityComposer');
        
    }
}
