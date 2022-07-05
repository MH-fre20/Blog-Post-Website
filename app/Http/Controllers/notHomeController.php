<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;

class notHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'create',
            'store', 'edit', 'update', 'destroy'
        ]);
    }

    public function home() {

        $user = auth()->user();
        $UserBlogPost = $user->BlogPost->take(5);
        
        return view('nothome.index', ['user' => $UserBlogPost]);
    }

    public function contact() 
    {
        return view('nothome.contact');
    }

    public function secret() 
    {
        return view('secret');
    }
}
