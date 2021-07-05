<?php


namespace App\Http\ViewComposer;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class ActivityComposer
{
    public function compose(View $view)
    {
        $mostActiveUser =    Cache::remember('most-active-user', now()->addSecond(10), function () {
            return  User::mostActiveUser()->take(5)->get();
        });
        $mostActiveUserLastMonth =    Cache::remember('most-active-user-last-month', now()->addSecond(10), function () {
            return  User::mostActiveUserLastMonth()->take(5)->get();
        });
        $mostComment =    Cache::remember('most-comments', now()->addSecond(10), function () {
            return   Post::mostCommented()->take(5)->get();
        });
        $view->with('most_commented', $mostComment);
        $view->with('most_active_user', $mostActiveUser);
        $view->with('most_active_user_last_month', $mostActiveUserLastMonth);
    }
}
