<?php

namespace App\Http\Livewire\Blog;

use Livewire\Component;
use App\Models\Post;

class Search extends Component
{

    public $search;

    public $open = false;

    public function updatedSearch($value){

        if ($value) {
            $this->open = true;
        }else{
            $this->open = false;
        }
    }


    public function render()
    {

        if ($this->search) {
            $posts = Post::where('title', 'LIKE' ,'%' . $this->search . '%')
                                ->where('status', 2)
                                ->get();
        } else {
            $posts = [];
        }

        return view('livewire.blog.search', compact('posts'));
    }
}
