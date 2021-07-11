<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostComment\StoreRequest;

class UserCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(User $user, StoreRequest $request)
    {
        $user->commentsOn()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id

        ]);

        // $request->session()->flash('status', 'Comment was created');
        return redirect()->back()->withStatus('Comment was created');
    }
}
