<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class PostTagController extends Controller
{
    public function index($tag)
    {
        $tags = Tag::findOrFail($tag);

        return view('posts.index', ['posts' => $tags->BlogPosts]);
    }
}
