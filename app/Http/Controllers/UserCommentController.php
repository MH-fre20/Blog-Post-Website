<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;

class UserCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(User $user,StoreComment $request)
    {
        //instead of using Comment::create()
        $user->commentOn()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id // you could use auth()->user()->id
        ]);

        $request->session()->flash('status', "Comment was created");
        
        return redirect()->back();
    } 
}
