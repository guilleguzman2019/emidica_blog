<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\TagBlog;

class HomeComponent extends Component
{
    use WithPagination;

    public $search;

    public function updatedSearch()
    {
        $this -> resetPage();
    }

    public function render()
    {
        $tags = TagBlog::all();
        $ultimosPosts = Post::latest()->take(3)->get();
        $categories = CategoryPost::all();
        $posts = Post::search($this -> search)
                          -> paginate(10);

        return view('livewire.admin.home-component', compact('categories', 'posts', 'ultimosPosts', 'tags'));
    }
}
