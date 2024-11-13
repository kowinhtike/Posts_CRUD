<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MyController extends Controller
{
    //
    public function goHome(){
        return view('home');
    }

    public function goAbout(){
        return view('about');
    }

    public function goPosts(){
        $posts = Post::all();
        return view('posts',compact('posts'));
    }

    public function goCreate(){
        return view('create');
    }
}
