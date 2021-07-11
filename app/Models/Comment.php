<?php

namespace App\Models;

use App\Scopes\LatestScope;
use App\Traits\Taggable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory, SoftDeletes, Taggable;

    protected $guarded = [];


    public static function boot()
    {
        parent::boot();

        static::creating(function (Comment $comment) {

            if ($comment->commentable_type === App\Models\Post::class) {

                Cache::tags(['blog-post'])->forgot('blog-post-{$comment->commentable_id}');
                Cache::tags(['blog-post'])->forgot('mostComment');
            }
        });
        // static::addGlobalScope(new LatestScope);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function post()
    // {
    //     return $this->belongsTo(Post::class);
    // }

    public function scopeLatestt(Builder $queary)
    {
        return $queary->orderBy(static::CREATED_AT, 'desc');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
    // public function tags()
    // {
    //     return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    // }
}
