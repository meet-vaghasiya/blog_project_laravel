<?php

namespace App\Providers;

use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Post' => 'App\Policies\PostPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Comment' => 'App\Policies\CommentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('update-post', function ($user, $post) {
        // });
        // Gate::define('delete-post', function ($user, $post) {
        // });

        Gate::define('post.update', [PostPolicy::class, 'update']);
        Gate::define('post.delete', [PostPolicy::class, 'delete']);

        // Gate::resource('posts', PostPolicy::class);
        Gate::define('home.contact', function ($user) {
            return $user->is_admin;
        });


        Gate::before(function ($user, $ability) {
            if ($user->is_admin && in_array($ability, ['update', 'delete'])) { //second in_array gives certain permission to perticular permission to admin only
                return true;
            }
        });  // check initially and never check other gates

        // Gate::after(function ($user, $ability, $result) {
        //     if ($user->is_admin ) { //second in_array gives certain permission to perticular permission to admin only
        //         return true;
        //     }
        // });  // check initially and never check other gates


    }
}
