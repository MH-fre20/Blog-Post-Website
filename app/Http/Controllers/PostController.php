<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;

//  controller => Policy
// 'show' => view,
//  destroy => delete

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'create',
            'store', 'edit', 'update', 'destroy'
        ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MostCommented = Cache::remember('MostCommented', 60, function () {
            return BlogPost::MostCommented()->take(5)->get();
        });

        $MostActive = Cache::remember('MostActive', now()->addSeconds(10), function () {
            return User::WithMostBlogPost()->take(5)->get();
        });

        $posts = BlogPost::withCount('comments')->with('user')->get();
        //$MostCommented = BlogPost::MostCommented()->take(5)->get();

        //$MostActive = User::WithMostBlogPost()->take(5)->get();
        
        return view('posts.index', ['posts' => $posts, 'MostCommented' => $MostCommented, 'MostActive' => $MostActive]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('posts.create');
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validated = $request->validated();
        $post = new BlogPost();
        $post->title = $validated['title'];
        $post->user_id = auth()->user()->id;
        $post->content = $validated['content'];
        $post->save();

        /*$post = BlogPost::create($validated);*/


        $request->session()->flash('status', 'blog was 
        created by yourself');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //abort_if(!isset($this->posts[$id]), 404);

        return view('posts.show', ['post' => BlogPost::with('comments')->FindorFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize('posts.update', $post);
        
        //Another way of doing the Gate thing
        //$this->authorize('update-post', $post);

        /* if (Gate::denies('posts.update', $post)) {
            abort(403, "you are not allowed");
        } */

        $validated = $request->validated();
        $post->update($validated);
        $post->save();

        $request->session()->flash('status', "Blog post was updated");
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        
        $this->authorize('posts.delete', $post);
        /* if (Gate::denies('posts.delete', $post)) {
            abort(403, "you are not allowed to Delete");
        } */
        $post->delete();
        session()->flash('status', 'blog post was deleted');

        return redirect()->route('posts.index');
    }
}
