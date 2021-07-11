<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // public function posts()
    // {
    //     return $this->belongsToMany(Post::class)->withTimestamps()->as('tag_pivot_table');
    // }


    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable')->withTimestamps()->as('tagg');
    }
    public function comments()
    {
        return $this->morphedByMany(Post::class, 'taggable')->withTimestamps()->as('tagg');
    }
}
