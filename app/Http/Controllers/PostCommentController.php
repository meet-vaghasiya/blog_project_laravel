<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted as EventsCommentPosted;
use App\Models\Post;
use App\Models\User;
use App\Jobs\ThrottleMail;
use App\Mail\CommentPosted;
use Illuminate\Http\Request;
use App\Mail\CommentPostedWatched;
use App\Mail\CommentPostedMarkdown;
use Illuminate\Support\Facades\Mail;
use App\Jobs\NotifyUserPostWasCreated;
use App\Http\Requests\PostComment\StoreRequest;
use App\Http\Resources\Comment;
use App\Http\Resources\CommentResource;

class PostCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Post $post)
    {
        // return new Comment($post->comments()->first());
        return  CommentResource::collection($post->comments()->with('user')->get());
        return $post->comments()->with('user')->get();
    }



    public function addComment(Post $post, StoreRequest $request)
    {

        $comment =   $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id

        ]);

event(new EventsCommentPosted($comment));


        // Mail::to($post->user)->send(
        //     // new CommentPosted($comment)
        //     new CommentPostedMarkdown($comment)
        // );
        // Mail::to($post->user)->queue(
        //     new CommentPostedMarkdown($comment)
        // );

        //     new CommentPostedMarkdown($comment)
        // ThrottleMail::dispatch( new CommentPostedMarkdown($comment),$post->user)->onQueue('high')              ;


        // NotifyUserPostWasCreated::dispatch($comment)->onQueue('low');

        
        // $when = now()->addMinutes(1);
        // Mail::to($post->user)->later(
        //     $when,
        //     new CommentPostedMarkdown($comment)
        // );

        // $request->session()->flash('status', 'Comment was created');
        return redirect()->back()->withStatus('Comment was created');
    }
}
