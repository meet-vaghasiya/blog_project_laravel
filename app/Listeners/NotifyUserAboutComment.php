<?php

namespace App\Listeners;

use App\Jobs\ThrottleMail;
use App\Events\CommentPosted;
use App\Mail\CommentPostedMarkdown;
use App\Jobs\NotifyUserPostWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUserAboutComment
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
    public function handle  (CommentPosted $event)
    {
                ThrottleMail::dispatch( new CommentPostedMarkdown($event->comment),$event->comment->commentable->user)->onQueue('high')              ;
                 NotifyUserPostWasCreated::dispatch($event->comment)->onQueue('low');

    }
}
