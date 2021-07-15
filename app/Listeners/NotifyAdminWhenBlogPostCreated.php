<?php

namespace App\Listeners;

use App\Jobs\ThrottleMail;
use App\Mail\PostAdded;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminWhenBlogPostCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        User::thatIsAdmin()->get()->map(
            function(User $user){
                ThrottleMail::dispatch(
                    new PostAdded(),
                    $user
                );
            }
        );

    }
}
