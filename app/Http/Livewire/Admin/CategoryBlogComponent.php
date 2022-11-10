<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\CategoryPost;

class CategoryBlogComponent extends Component
{

    use WithFileUploads;

    public $categories, $category, $image, $imageTable, $ico, $megamenu, $imageEdit, $imageTableEdit, $icoEdit, $megamenuEdit;

    public $editArray = [];

    public $createArray = [
        'name' => null,
        'slug' => null,
        'description'=> 'descripcion de la categoria',
        'image' => null
    ];

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');

        $this -> getCategories();
    }

    public function updatedCreateArrayName($value)
    {
        $this -> createArray['slug'] = Str::slug($value);
    }

    public function updatedEditArrayName($value)
    {
        $this -> editArray['slug'] = Str::slug($value);
    }

    public function getCategories()
    {
        $this -> categories = CategoryPost::all();
    }


    public function save()
    {

        $toValidate = [
            'createArray.name' => 'required',
            'createArray.slug' => 'required|unique:products,slug',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:4096'
        ];

        $this -> validate($toValidate);

        if ( $this -> image )
            $this -> createArray['image'] = $this -> image -> store('img/categories');


        CategoryPost::create( $this -> createArray );

        $this -> reset('createArray', 'image');

        $this -> getCategories();
    }

    public function edit(CategoryPost $category)
    {
        $this -> reset(['imageEdit']);
        $this -> resetValidation();

        $this -> category = $category;

        $this -> editArray['name'] = $category -> name;
        $this -> editArray['slug'] = $category -> slug;
        $this -> editArray['image'] = $category -> image;

    }

    public function update()
    {
        $toValidate = [
            'editArray.name' => 'required',
            'editArray.slug' => 'required|unique:products,slug,' . $this -> category -> id,
            'imageEdit' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
        ];

        $this -> validate($toValidate);

        if ( $this -> imageEdit ) {
            Storage::disk('public') -> delete( $this -> category -> image );
            $this -> editArray['image'] = $this -> imageEdit -> store('img/categories');
        }

        if ( $this -> imageTableEdit ) {
            Storage::disk('public') -> delete( $this -> category -> image_reference );
            $this -> editArray['image_reference'] = $this -> imageTableEdit -> store('img/categories');
        }


        $this -> category -> update( $this -> editArray );

        $this -> reset(['editArray', 'imageEdit']);
        $this -> getCategories();
        $this -> emit('updated');
    }

    public function destroy(CategoryPost $category)
    {

        Storage::disk('public') -> delete($category -> image);

        $category -> delete();
        $this -> getCategories();
    }


    public function render()
    {
        return view('livewire.admin.category-blog-component');
    }
}
