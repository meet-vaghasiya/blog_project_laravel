<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\updateRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', ['posts' => Post::all()]);
    }

    public function show(Post $post)
    {
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
