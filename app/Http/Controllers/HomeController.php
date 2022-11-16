<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\TagBlog;


class HomeController extends Controller
{
    public function index()
    {
        //$posts = Post::latest()->take(6)->published()->get();
        $categories = CategoryPost::all();
        //$posts = Post::all()->paginate(10);

        $posts = Post::paginate(3);

        return view('blog' , compact('posts', 'categories'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->first();
        // $posts = Post::latest()->take(3)->published()->get();
        // Increase View count

        return view('post', compact('post'));
    }

    public function category(?string $category_slug = null)
    {

        $category = CategoryPost::where('slug', $category_slug)->first();

        $posts = Post::where('category_id', $category->id)
                            ->latest()
                            ->paginate(1);

        return view('blog.category', compact('category_slug','posts'));
    }


    public function tag(TagBlog $tag)
    {
        $posts = Post::whereHas('postTags', function (Builder $query) use ( $tag ) {
            return $query -> where('tagBlog_id', $tag -> id) -> with('tagBlogs');
        }) ->paginate(10);

        return view('blog.tag', compact('posts'));
    }
}
