<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
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

    public function manyToMany()
    {
        // dd('adsfafd');
        // $tag = new Tag();
        // $tag->name = 'tag5';
        // // $tag->save();
        // $tag1 = new Tag();
        // $tag1->name = 'tag5';
        // // $tag1->save();

        // $tag1 = Tag::find(4);
        // $tag2 = Tag::find(3);


        // $post = Post::find(2);
        // $post->tags()->attach($tag);
        // $post->tags()->attach([$tag1->id, $tag2->id]);
        // $post->tags()->detach([$tag1->id, $tag2->id]);
        // $post->tags()->syncWithoutDetaching([$tag1->id, $tag2->id]);
        // $post->tags()->sync([]);

        // $tag = Tag::with('posts')->find(3);
        // $tag = Tag::with('posts')->find(3);
        // $tag = Tag::find(4);
        // $tag->posts;

        // $post = Post::find(1);
        // $post->tags;
        // dd(($post->tags)[0]->post_pivot_table);
    }


    public function index()
    {
        // $post = Post::all()->pluck('id');
        // $post = Post::withTrashed()->get()->pluck('id');
        // $post = Post::onlyTrashed()->get();
        // $post = Post::find(1)->forceDelete();
        // $post = Post::find(5);
        // dd($post);


        // $post = Post::latestttt()->withCount('comments')->with(['user', 'tags'])->get();
        // dump($post);
        // dump($post);

        return view('posts.index', [
            'posts' => Post::latestWithRelations()->get(),

        ]);
    }

    public function show($post)
    {
        // $post = Post::with(['comments' => function ($q) {
        //     return   $q->latestt( );
        // }])->findOrFail($post);

        $post = Post::with(['comments', 'tags'])->findOrFail($post); //here we define latest() directly in modal

        $postCache = Cache::tags(['blog-post'])->remember('post-{$post->id}', now()->addSecond(10), function () use ($post) {
            return Post::with(['comments', 'tags'])->findOrFail($post->id); //here we define latest() directly in modal
        });

        $sessionId = session()->getId();
        $counterKey = 'post-{$post->id}-counter';
        $userKey = 'post-{$post->id}-users';
        Cache::tags(['blog-post'])->forever($counterKey, 1);

        $users = Cache::tags(['blog-post'])->get($userKey, []);
        $userUpdated = [];
        $diffence = 0;
        $now = now();


        foreach ($users as $session => $lastVisit) {
            if (now()->diffInMinutes($lastVisit)  >= 1) {
                $diffence--;
            } else {
                $userUpdated[$session] = $lastVisit;
            }
        }
        if (!array_key_exists($sessionId, $users) || now()->diffInMinutes($users[$sessionId]) >= 1) {
            $diffence++;
        }

        $userUpdated[$sessionId] = $now;
        Cache::forever($userKey, $userUpdated);

        if (!Cache::has($counterKey)) {
            Cache::tags(['blog-post'])->forever($counterKey, 1);
        } else {
            Cache::increment($counterKey, $diffence);
        }

        $counter = Cache::tags(['blog-post'])->get($counterKey);

        return view('posts.show', ['post' => $postCache, 'counter' => $counter]);
    }

    public function edit($post)
    {
        // dd(Post::find($post));
        // dd($post);


        // Cache::put('data', 'test data store', 5);
        // Cache::get('data');
        // Cache::get('data', 'this is default value');
        // Cache::has('data');
        // Cache::increment('counter');
        // Cache::decrement('counter');

        // Cache::tags(['people', 'artists'])->put('john', 'Hello Im john');
        // Cache::tags(['people', 'author'])->put('test', 'test category');
        // Cache::tags(['people'])->flush();




        $postCache = Cache::tags(['blog-post'])->remember('post-{$post->id}', now()->addSecond(10), function () use ($post) {
            return Post::with('comments')->findOrFail($post); //here we define latest() directly in modal
        });
        return view('posts.edit', ['post' => $postCache]);
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
        $hasFile = $request->hasFile('thumbnail');
        if ($hasFile) {
            $file = $request->file('thumbnail');

            // $ff =    $file->store('thumbnail');
            // Storage::disk("public")->putFile('thumbnails', $file);

            // $file1 = $file->storeAs('thumbnails', Str::random(10) . '.' . $file->getClientOriginalExtension());
            // Storage::putFileAs('thumbn', $file, Str::random(10) . '.' . $file->guessClientExtension());
            // dump(Storage::url($file1), $file1, $file2);
            // dd(Storage::disk('public')->url($file2));
            $file_path =    Storage::disk('public')->putFileAs('thumbnails', $file, Str::random(10) . '.' . $file->guessClientExtension());

            // $post->image()->save(
            //     Image::create([
            //         'path' => $file_path
            //     ])
            // );
            $post->image()->save(
                Image::make([
                    'path' => $file_path
                ])
            );
        }


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

        $hasFile =  $request->hasFile('thumbnail');
        if ($hasFile) {
            $file = $request->file('thumbnail');
            $file_path =    Storage::disk('public')->putFileAs('thumbnails', $file, Str::random(10) . '.' . $file->guessClientExtension());

            if ($post->image) {
                Storage::disk('public')->delete($post->image->path);
                $post->image->path = $file_path;
                $post->image->save();
            } else {

                $post->image()->save(
                    Image::make([
                        'path' => $file_path
                    ])
                );
            }
        }
        $request->session()->flash('status', 'The blog post was created');

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        Storage::disk('public')->delete($post->image->path);

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
