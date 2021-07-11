<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\CommentPosted;
use Illuminate\Http\Request;
use App\Mail\CommentPostedMarkdown;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PostComment\StoreRequest;

class PostCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function addComment(Post $post, StoreRequest $request)
    {
        $comment =   $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id

        ]);

        Mail::to($post->user)->send(
            // new CommentPosted($comment)
            new CommentPostedMarkdown($comment)
        );

        // $request->session()->flash('status', 'Comment was created');
        return redirect()->back()->withStatus('Comment was created');
    }
}
