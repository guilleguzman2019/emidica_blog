<?php

namespace App\Http\Livewire\Admin\Post;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public $categories, $image;


    public $createArray = [
        'user_id' => 8,
        'title' => null,
        'slug' => '',
        'body' => null,
        'status' => 1,
        'category_id' => ''
    ];

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');

        $this-> createArray['user_id'] = Auth::id();

        $this -> categories = CategoryPost::all();
    }

    public function updatedCreateArraytitle($value)
    {
        $this -> createArray['slug'] = Str::slug($value);
    }


    public function save()
    {

        $toValidate = [
            'createArray.title' => 'required',
            'createArray.slug' => 'required|unique:products,slug',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'createArray.body' => 'required'
        ];

        $this -> validate($toValidate);


        if ( $this -> image ) {
            $this -> createArray['image'] = $this -> image -> store('/img/post');
        }


        $post = Post::create( $this -> createArray);

        return redirect() -> route('admin.post.index', $post);
    }



    public function render()
    {
        return view('livewire.admin.post.create');
    }
}
