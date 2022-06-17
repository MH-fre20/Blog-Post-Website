<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class PostTagController extends Controller
{
    public function index($tag)
    {
        $tags = Tag::findOrFail($tag);
        $tag = $tags->BlogPosts;
        //dd($posts);
        return view('posts.index', compact('tag'));
    }
}
