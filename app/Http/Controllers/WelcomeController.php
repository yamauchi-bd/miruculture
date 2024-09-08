<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class WelcomeController extends Controller
{
    public function index()
    {
        $latestPosts = Post::latest()->take(6)->get();
        return view('welcome', compact('latestPosts'));
    }
}