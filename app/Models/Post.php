<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function (Post $post) {
            $post->comments()->delete();   //  we can add multiple relationship data here
        });

        static::restoring(function (Post $post) {
            $post->comments()->restore(); //  we can add multiple relationship data here
        });
    }
}
