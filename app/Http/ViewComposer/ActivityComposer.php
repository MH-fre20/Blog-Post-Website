<?php 

namespace App\Http\ViewComposer;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Illuminate\Support\ServiceProvider;

class ActivityComposer
{
    public static function compose(View $view)
    {
        $MostCommented = Cache::remember('MostCommented', 60, function () {
            return BlogPost::MostCommented()->take(5)->get();
        });
        
        //('MostCommented', 60, function () {});

        $MostActive = Cache::remember('MostActive', now()->addSeconds(10), function () {
            return User::WithMostBlogPost()->take(5)->get();
        });

        $posts = BlogPost::withCount('comments')->with('user')->with('tags')->get();
        //$MostCommented = BlogPost::MostCommented()->take(5)->get();

        //$MostActive = User::WithMostBlogPost()->take(5)->get();

        $view->with('MostCommented', $MostCommented);
        $view->with('MostActive', $MostActive);
        $view->with('posts', $posts);
    }
}