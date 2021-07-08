<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostComment\StoreRequest;

class PostCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function addComment(Post $post, StoreRequest $request)
    {
        $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id

        ]);

        $request->session()->flash('status', 'Comment was created');
        return redirect()->back();
    }
}
