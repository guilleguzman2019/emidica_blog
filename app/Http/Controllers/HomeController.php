<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CategoryPost;


class HomeController extends Controller
{
    public function index()
    {
        //$posts = Post::latest()->take(6)->published()->get();
        $categories = CategoryPost::all();
        //$posts = Post::all()->paginate(10);

        $posts = Post::paginate(3);

        return view('blog', compact('categories','posts'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->first();
        // $posts = Post::latest()->take(3)->published()->get();
        // Increase View count

        return view('post', compact('post'));
    }
}
