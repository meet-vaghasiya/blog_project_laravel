<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Cache;

class CommentObserver
{
    
    public function creating(Comment $comment)
    {
        if ($comment->commentable_type === Post::class) {
                // Cache::tags(['blog-post'])->forgot("blog-post-{$comment->commentable_id}");
                // Cache::tags(['blog-post'])->forgot('mostComment');
            }
    }

}
