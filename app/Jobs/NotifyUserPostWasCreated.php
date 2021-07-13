<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Comment;
use App\Jobs\ThrottleMail;
use Illuminate\Bus\Queueable;
use App\Mail\CommentPostedWatched;
use App\Mail\CommentPostedMarkdown;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NotifyUserPostWasCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // public $tries =15;
    // public $timeout = 30;
    public $comment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $now =  now();

        User::thatHasCommentOnPost($this->comment->commentable)->get()->filter(function (User $user) {
            return $user->id != $this->comment->user_id;
        })->map(function(User $user) use ($now){

            ThrottleMail::dispatch(new CommentPostedMarkdown($this->comment), $user);


            // Mail::to($user)->later($now->addSeconds(6),
            //     new CommentPostedWatched($this->comment,$user)
            // );
        });
        
    }
}
