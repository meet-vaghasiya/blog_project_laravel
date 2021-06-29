<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\updateRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function hasMany()
    {
        // $post = Post::find(5);
        $commenet = new Comment();
        // $commenet->content = 'fake content';
        // $post->comments()->save($commenet);

        // $comment = Comment::all()->dd();

        // $commenet->content = 'second table';
        // $commenet->post_id = 6;
        // $commenet->save();


        //multiple relationship loading
        // $com1 = new Comment();
        // $com2 = new Comment();
        // $com3 = new Comment();

        // $com1->content = 'multiple';
        // $com2->content = 'multiple2';
        // $com3->content = 'multiple3';

        // $post = Post::find(11);
        // $post->comments()->saveMany(([$com1, $com2, $com3]));


        //assocuate using commnet
        // $post = Post::find(11);
        // $comment  = new Comment();
        // $comment->content = 'new new';

        // $comment->post()->associate($post)->save();



        // $post = Post::all();
        // // $post = Post::with('comments')->get();

        // $post = Post::with('comments')->find(11);


        // $post = Post::has('comments')->get();
        // $post = Post::has('comments', '>=', 2)->get();

        // $post = Post::whereHas('comments', function ($q) {
        //     $q->where('content', 'like', '%con%');
        // })->get();


        // $post = Post::doesntHave('comments')->get();
        // $post = Post::whereDoesntHave('comments', function ($q) {
        //     $q->where('content', 'like', '%con%');
        // })->get();

        // $post = Post::withCount('comments')->get();
        // $post = Post::withCount(['comments', 'comments as new_commetnts' => function ($q) {
        //     $q->where('created_at', '>', '2021-06-26 16:04:05');
        // }])->get();


        // dd($post);
    }


    public function index()
    {
        return view('posts.index', ['posts' => Post::withCount('comments')->get()]);
    }

    public function show($post)
    {

        $post = Post::with('comments')->findOrFail($post);

        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        // dd(Post::find($post));
        // dd($post);
        return view('posts.edit', ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }
    public function store(StoreRequest $request)
    {
        // $request->validate([
        //     'title' => 'required|max:100',
        //     'content' => 'required|min:3|max:100',

        // ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        $request->session()->flash('status', 'The blog post was created');
        return redirect()->back();
    }

    public function update(updateRequest $request, Post $post)
    {
        // dd($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        $request->session()->flash('status', 'The blog post was created');

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::destroy($id);
        $request->session()->flash('status', 'The blog Deleted succesfuly');

        return redirect()->back();
    }
}
