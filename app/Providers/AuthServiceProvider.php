<?php

namespace App\Providers;

use App\Policies\BlogPostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy'
        'App\Models\User' => 'App\Policies\UserPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('hello_mohamad', function ($user) {
            return $user->is_admin;
        });

        /* Gate::define('update-post', function ($user, $post) {
            return $user->id == $post->user_id;
        }); */

        /* Gate::define('posts.update', [BlogPostPolicy::class, 'update']);
        Gate::define('posts.delete', [BlogPostPolicy::class, 'delete']); */

        Gate::resource('posts', BlogPostPolicy::class);

        /* Gate::define('delete-post', function ($user, $post) {
            //return true or false
            return $user->id == $post->user_id;
        }); */

        Gate::before(function ($user, $ability) {
            if ($user->is_admin == 1 && in_array($ability, ['update', 'delete'])) {
                return true;
            }
        }); 
    }
}
