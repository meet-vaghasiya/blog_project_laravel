<?php

namespace App\Models;

use App\Scopes\DeleteScope;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class)->latestt(); // we define in local scope
    }

    public static function boot()
    {
        static::addGlobalScope(new DeleteScope); //put this before boot method
        parent::boot();

        // static::addGlobalScope(new LatestScope);

        static::deleting(function (Post $post) {
            $post->comments()->delete();   //  we can add multiple relationship data here
        });

        static::restoring(function (Post $post) {
            $post->comments()->restore(); //  we can add multiple relationship data here
        });

        static::updating(function (Post $post) {
            Cache::forget('post-{$post->id}');
        });
    }

    public function scopeLatestttt(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query)
    {
        return $query->withCount("comments")->orderBy('comments_count', 'desc');
    }

    //relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
