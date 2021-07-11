<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class CommentPosted extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('emails.posts.comments');
        // return $this->from('admin@gmail.com')->subject("Comment posted on your {$this->comment->commentable->title} blog post")->view('emails.posts.comments');
        // return $this->attach(storage_path('app/public/' . $this->comment->user->image->path))->subject("Comment posted on your {$this->comment->commentable->title} blog post")->view('emails.posts.comments');
        return $this
            // ->attach(storage_path('app/public/avatars/' . $this->comment->user->image->path))
            // ->attach(storage_path('app/public/' . $this->comment->user->image->path), [
            //     'as' => 'users_profiles.jpg',
            //     'mime' => 'image/jpeg'
            // ])
            // ->attachFromStorage($this->comment->user->image->path, 'user-profile.jpg')
            // ->attachFromStorageDisk('public', $this->comment->user->image->path, 'user-profile.jpg')
            ->attachData(Storage::get($this->comment->user->image->path), 'profile_pic', ['mime' => 'image/jpg'])
            ->subject("Comment posted on your {$this->comment->commentable->title} blog post")
            ->view('emails.posts.comments');
    }
}
