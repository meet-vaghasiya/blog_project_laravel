<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeMostActiveUser(Builder $query)
    {
        return $query->withCount('posts')->orderBy('posts_count', 'desc');
    }
    public function scopeMostActiveUserLastMonth(Builder $query)
    {
        // return $query->withCount(['posts' => function ($q) {
        //     $q->where('created_at', '>=', now()->subMonth(1));
        // }])->having('posts_count', '>=', 2)->orderBy('posts_count', 'desc');

        return $query->withCount(['posts' => function ($q) {
            $q->where('created_at', '>=', now()->subMonth(1));
        }])->has('posts', '>=', 2)->orderBy('posts_count', 'desc');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
