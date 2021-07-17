<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Events\CommentPosted as EventsCommentPosted;
use App\Models\Comment;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


public function __construct()
{
    $this->middleware('auth:api')->only(['store']);
}



    public function index(Post $post,Request $request)
    {
        $perPage=  $request->per_page?? 15;
        return  CommentResource::collection($post->comments()->with('user')->paginate($perPage)->appends([
            'per_page'=>$perPage
        ]));
        // return  CommentResource::collection($post->comments()->with('user')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post,Request $request)
    {
        //
        $comment =   $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id

        ]);

        event(new EventsCommentPosted($comment));
        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post,Comment $comment)
    {

        return new CommentResource($comment);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, Comment $comment,Request $request)
    {
        $this->authorize( $comment); //above and belove both are same

        $comment->content = $request->input('content');
        $comment->save();
        return new CommentResource($comment);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize( $comment); //above and belove both are same

        $comment->delete();
        return response()->noContent();
    }
}
