<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    public function index($id)
    {
        $tag = Tag::findOrFail($id);
        return view('posts.index', ['posts' => $tag->posts, 'most_commented' => [], 'most_active_user' => [], 'most_active_user_last_month' => []]);
    }
}
