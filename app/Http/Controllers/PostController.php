<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\Image;
use App\Models\User;
use Illuminate\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

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
        /* Cache::put('cachekey', 'thats it', now()->addDays(1));
        dd(Cache::get('cachekey')); */


        $posts = BlogPost::withCount('comments')->with('user')->with('tags')->get();
        //$MostCommented = BlogPost::MostCommented()->take(5)->get();

        //$MostActive = User::WithMostBlogPost()->take(5)->get();

        return view('posts.index', ['posts' => $posts]);
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
        //BlogPost::create($validated);
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');

            //storing using relations
            $post->Image()->save(
                Image::make(['path' => $path]));
        }
        /*  $hasFile = $request->hasFile('thumbnail');
        if ($hasFile) {
            $file = $request->file('thumbnail'); */
        /* dump($file);
            dump($file->getClientMimeType());
            dump($file->getClientOriginalExtension());
            dd($file->getClientOriginalName()); */
        /* 
            $file->store('thumbnails');

            //get the url of the stored file 
            dd(Storage::url($file)); */
        //
        /*  dd(Storage::disk('public')->put('thumbnails', $file)); */
        /*  }
        die; */

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

        $blogpost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 60, function () use ($id) {
            return BlogPost::with('comments')->with('tags')->FindorFail($id);
        });

        //To count the viewer of the page
        $sessionId = session()->getId();
        $counterKey = "blog-post-{$id}-counter";
        $usersKey = "blog-post-{$id}-users";

        $users = Cache::get($usersKey, []);
        $usersUpdate = [];
        $difference = 0;

        foreach ($users as $session => $lastVisit) {
            if (now()->diffInMinutes($lastVisit) >= 1) {
                $difference--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if (
            !array_key_exists($sessionId, $users)
            || now()->diffInMinutes($users[$sessionId]) >= 1
        ) {
            $difference++;
        }

        $usersUpdate[$sessionId] = now();
        Cache::forever($usersKey, $usersUpdate);

        if (!Cache::has($counterKey)) {
            Cache::forever($counterKey, 1);
        } else {
            Cache::increment($counterKey, $difference);
        }

        $counter = Cache::get($counterKey);

        return view('posts.show', [
            'post' => $blogpost,
            'counter' => $counter
        ]);
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
        //$this->authorize('posts.update', $post);
        //Another way of doing the Gate thing
        //$this->authorize('update-post', $post);

        /* if (Gate::denies('posts.update', $post)) {
            abort(403, "you are not allowed");
        } */
        $validated = $request->validated();
        $post->update($validated);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');

            if ($post->Image) {
                Storage::delete($post->Image->path);
                $post->Image->path = $path;
                $post->Image->save();
            } else {
                //storing using relations
                $post->Image()->save(
                    Image::make(['path' => $path])
                );
            }
        }
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

        //$this->authorize('posts.delete', $post);
        /* if (Gate::denies('posts.delete', $post)) {
            abort(403, "you are not allowed to Delete");
        } */
        $post->delete();
        session()->flash('status', 'blog post was deleted');

        return redirect()->route('posts.index');
    }
}
