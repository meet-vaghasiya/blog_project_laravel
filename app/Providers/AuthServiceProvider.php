<?php

namespace App\Providers;

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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-post', function ($user, $post) {
            return $user->id == $post->user_id;
        });
        Gate::define('delete-post', function ($user, $post) {
            return $user->id == $post->user_id;
        });

        Gate::before(function ($user, $ability) {
            if ($user->is_admin && in_array($ability, ['update-post', 'delete-post'])) { //second in_array gives certain permission to perticular permission to admin only
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
