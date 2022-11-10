<?php

namespace App\Http\Livewire\Admin\Post;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Post ;
use Livewire\WithPagination;

class Index extends Component
{

    public $actualizar = false;

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');
    }

    public function delete(Post $post)
    {
        //$post -> slug = $post -> slug . '-trash';
        //$post -> sku = $post -> sku . '-trash';
        //$post -> save();
        $post -> delete();

        $this -> actualizar = true ;
    }


    public function render()
    {

        $posts = Post::all();

        return view('livewire.admin.post.index' , compact('posts'));
    }
}
