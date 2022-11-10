<?php

namespace App\Http\Livewire\Admin\Post;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Post;
use App\Models\TagBlog;
use App\Models\CategoryPost;
use App\Models\PostTag;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;

    public $slug, $image, $post, $categories, $tags, $etiquetas;

    protected $rules = [
        'post.title' => 'required',
        'post.body' => 'required',
        'post.status' => 'required',
        'post.category_id' => 'required',
        'slug' => 'required',
        'etiquetas' => 'nullable'

    ];

    

    public function mount(Post $post)
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');

            $this -> post = $post ; 

            $this -> slug = $this -> post -> slug;

            $this -> tags = TagBlog::all();

            $this -> categories = CategoryPost::all();
        
    }


    public function save()
    {

        $rules = $this -> rules;
        //$rules['slug'] = 'required|unique:post,slug,' . $this -> post -> id;

        $this -> validate($rules);

        if ( $this -> image ) {
            Storage::disk('public') -> delete( $this -> post -> image );
            $this -> post -> image = $this -> image -> store('img/post');
        }

        $this -> post -> slug = $this -> slug;
        $this -> post -> save();

        if ( count( $this -> etiquetas ) ) {
            foreach ($this -> etiquetas as $etiq) {
                PostTag::create([
                    'post_id' => $this -> post -> id,
                    'tagBlog_id' => $etiq
                ]);
            }
        }

        $this -> refreshPost();

        return redirect() -> route('admin.post.index');


    }

    public function refreshPost()
    {
        $this -> post = $this -> post -> fresh();
    }

    public function render()
    {
        return view('livewire.admin.post.edit');
    }
}
