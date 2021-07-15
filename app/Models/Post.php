<?php

namespace App\Models;

use App\Scopes\DeleteScope;
use App\Scopes\LatestScope;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory, SoftDeletes, Taggable;

    protected $guarded = [];



    public static function boot()
    {
        static::addGlobalScope(new DeleteScope); //put this before boot method
        parent::boot();

        // static::addGlobalScope(new LatestScope);

        // static::deleting(function (Post $post) {
        //     $post->comments()->delete();   //  we can add multiple relationship data here
        //     $post->image()->delete();
        //     Cache::tags(['blog-post'])->forget("post-{$post->id}");

        // });

        static::restoring(function (Post $post) {
            $post->comments()->restore(); //  we can add multiple relationship data here
        });

        // static::updating(function (Post $post) {
        //     Cache::tags(['blog-post'])->forget("post-{$post->id}");
        // });
    }

    public function scopeLatestttt(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query)
    {
        return $query->withCount("comments")->orderBy('comments_count', 'desc');
    }

    public function scopeLatestWithRelations(Builder $query)
    {
        return $query->latest()->withCount('comments')->with('user')->with('tags');
    }

    //relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class)->latestt(); // we define in local scope
    // }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->latestt(); // we define in local scope
    }

    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class)->withTimestamps()->as('post_pivot_table');
    // }
    // public function tags()
    // {
    //     return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    // }

    // public function image()
    // {
    //     return $this->hasOne(Image::class);
    // }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
