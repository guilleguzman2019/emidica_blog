<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;

class CategoryComponent extends Component
{

    use WithFileUploads;

    public $categories, $category, $image, $imageTable, $ico, $megamenu, $imageEdit, $imageTableEdit, $icoEdit, $megamenuEdit;

    public $createArray = [
        'name' => null,
        'slug' => null,
        'image' => null,
        'image_reference' => null,
        'ico' => null,
        'megamenu' => null,
        'featured' => 0,
        'parent_id' => null,
    ];

    public $editArray = [];

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

    public function getCategories()
    {
        $this -> categories = Category::where('parent_id', NULL) -> orderBy('name') -> get();
    }

    public function save()
    {
        $toValidate = [
            'createArray.name' => 'required',
            'createArray.slug' => 'required|unique:products,slug',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'imageTable' => 'nullable|image|mimes:png,svg|max:4096',
            'ico' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'megamenu' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
        ];

        $this -> validate($toValidate);

        if ( $this -> image )
            $this -> createArray['image'] = $this -> image -> store('img/categories');

        if ( $this -> imageTable )
            $this -> createArray['image_reference'] = $this -> imageTable -> store('img/categories');

        if ( $this -> ico )
            $this -> createArray['ico'] = $this -> ico -> store('img/icons');

        if ( $this -> megamenu )
            $this -> createArray['megamenu'] = $this -> megamenu -> store('img/categories');

        Category::create( $this -> createArray );

        $this -> reset('createArray', 'image', 'imageTable', 'ico', 'megamenu');
        $this -> getCategories();

        $this -> emit('saved');
    }

    public function edit(Category $category)
    {
        $this -> reset(['imageEdit', 'imageTableEdit', 'icoEdit', 'megamenuEdit']);
        $this -> resetValidation();

        $this -> category = $category;

        $this -> editArray['name'] = $category -> name;
        $this -> editArray['slug'] = $category -> slug;
        $this -> editArray['image'] = $category -> image;
        $this -> editArray['image_reference'] = $category -> image_reference;
        $this -> editArray['ico'] = $category -> ico;
        $this -> editArray['megamenu'] = $category -> megamenu;
        $this -> editArray['featured'] = $category -> featured;
        $this -> editArray['parent_id'] = $category -> parent_id;
    }

    public function update()
    {
        $toValidate = [
            'editArray.name' => 'required',
            'editArray.slug' => 'required|unique:products,slug,' . $this -> category -> id,
            'imageEdit' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'imageTableEdit' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'icoEdit' => 'nullable|image|mimes:png,svg|max:4096',
            'megamenuEdit' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
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

        if ( $this -> icoEdit ) {
            Storage::disk('public') -> delete( $this -> category -> ico );
            $this -> editArray['ico'] = $this -> icoEdit -> store('img/icons');
        }

        if ( $this -> megamenuEdit ) {
            Storage::disk('public') -> delete( $this -> category -> megamenu );
            $this -> editArray['megamenu'] = $this -> megamenuEdit -> store('img/categories');
        }

        $this -> category -> update( $this -> editArray );

        $this -> reset(['editArray', 'imageEdit', 'imageTableEdit', 'icoEdit', 'megamenuEdit']);
        $this -> getCategories();
        $this -> emit('updated');
    }

    public function destroy(Category $category)
    {
        Storage::disk('public') -> delete($category -> image);
        Storage::disk('public') -> delete($category -> imageTable);
        Storage::disk('public') -> delete($category -> ico);
        Storage::disk('public') -> delete($category -> megamenu);
        $category -> delete();
        $this -> getCategories();
    }

    public function render()
    {
        return view('livewire.admin.category-component');
    }
}
