<?php

namespace App\Providers;

use App\Http\Resources\CommentResource;
use App\Models\Post;
use App\Models\Comment;
use App\Observers\PostObserver;
use App\Observers\CommentObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposer\ActivityComposer;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::aliasComponent('components.badge', 'badge');
        Blade::aliasComponent('components.updated', 'updated');
        Blade::aliasComponent('components.cards', 'cards');
        Blade::aliasComponent('components.tags', 'tags');
        Blade::aliasComponent('components.errors', 'errors');
        Blade::aliasComponent('components.comment-form', 'commentForm');
        Blade::aliasComponent('components.comment-list', 'commentList');

        // view()->composer('*', ActivityComposer::class);
        view()->composer(['posts.index', 'posts.show'], ActivityComposer::class);


        Post::observe(PostObserver::class);
        Comment::observe(CommentObserver::class);

        // CommentResource::withoutWrapping();
        JsonResource::withoutWrapping();
    }
}
