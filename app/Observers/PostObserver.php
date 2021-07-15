<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{

    public function deleting(Post $post)
    {
        $post->comments()->delete();   //  we can add multiple relationship data here
        $post->image()->delete();
        Cache::tags(['blog-post'])->forget("post-{$post->id}");
    }

    public function updating(Post $post)
    {
        Cache::tags(['blog-post'])->forget("post-{$post->id}");
    }

    public function restoring(Post $post)
    {
        
        $post->comments()->restore(); //  we can add multiple relationship data here

    }
}
