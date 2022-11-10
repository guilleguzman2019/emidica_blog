<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Tag;

class TagComponent extends Component
{

    public $tag, $editArray = [];

    public $createArray = [
        'name' => null,
        'slug' => null,
        'status' => 1
    ];

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');
    }

    public function updatedCreateArrayName($value)
    {
        $this -> createArray['slug'] = Str::slug($value);
    }

    public function updatedEditArrayName($value)
    {
        $this -> editArray['slug'] = Str::slug($value);
    }

    public function save()
    {
        $this -> validate([
            'createArray.name' => 'required',
            'createArray.slug' => 'required|unique:products,slug',
        ]);

        Tag::create( $this -> createArray );

        $this -> reset('createArray');
        $this -> emit('saved');
    }

    public function edit(Tag $tag)
    {
        $this -> resetValidation();

        $this -> tag = $tag;

        $this -> editArray['name'] = $tag -> name;
        $this -> editArray['slug'] = $tag -> slug;
        $this -> editArray['status'] = $tag -> status;
    }

    public function update()
    {
        $this -> validate([
            'editArray.name' => 'required',
            'editArray.slug' => 'required|unique:products,slug,' . $this -> tag -> id,
        ]);

        $this -> tag -> update( $this -> editArray );

        $this -> reset(['editArray']);
        $this -> emit('updated');
    }

    public function destroy(Tag $tag)
    {
        $tag -> delete();
        $this -> emit('deleted');
    }

    public function render()
    {
        $tags = Tag::orderBy('id', 'DESC') -> get();
        return view('livewire.admin.tag-component', compact('tags'));
    }
}
