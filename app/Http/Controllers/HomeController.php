<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {


        $author = Author::with('profile')->get();
        // dd($author);

        return view('home.index');
    }
    public function contact()
    {
        return view('home.contact');
    }
}
