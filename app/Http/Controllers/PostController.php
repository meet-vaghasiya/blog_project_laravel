<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\updateRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'update', 'destroy']);
    }


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


        //soft deleted posts


    }


    public function index()
    {
        // $post = Post::all()->pluck('id');
        // $post = Post::withTrashed()->get()->pluck('id');
        // $post = Post::onlyTrashed()->get();
        // $post = Post::find(1)->forceDelete();
        // $post = Post::find(5);
        // dd($post);
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
        $post->user_id = Auth::id();
        $post->save();

        $request->session()->flash('status', 'The blog post was created');
        return redirect()->back();
    }

    public function update(updateRequest $request, Post $post)
    {
        // dd($id);

        // if (Gate::denies('update-post', $post)) {
        //     abort(403, 'You can\'t edit this page'); // second argument is for message
        // }
        // $this->authorize('update-post', $post); //above and belove both are same
        $this->authorize('update', $post); //above and belove both are same



        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        $request->session()->flash('status', 'The blog post was created');

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // if (Gate::denies('update-post', $post)) {
        //     abort(403, 'You can\'t edit this page'); // second argument is for message
        // }

        // $user = User::find(1);
        // $store_value = Gate::forUser($user)->denies('update-post', $post); // if user is not authorize than it will return true
        // $store_value = Gate::forUser($user)->allows('update-post', $post); //opposite of allows


        // over riding permission
        // dd($store_value);

        // $this->authorize('delete-post', $post); //above and belove both are same
        $this->authorize('delete', $post); //above and belove both are same



        $post = Post::destroy($id);

        $request->session()->flash('status', 'The blog Deleted succesfuly');

        return redirect()->back();
    }
}
