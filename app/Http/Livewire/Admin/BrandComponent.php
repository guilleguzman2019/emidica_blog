<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Brand;

class BrandComponent extends Component
{

    use WithFileUploads;

    public $brand, $logo, $logoEdit;

    public $createArray = [
        'name' => null,
        'logo' => null,
        'featured' => 0,
    ];

    public $editArray = [];

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');
    }

    public function save()
    {
        $this -> validate([
            'createArray.name' => 'required',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:4096'
        ]);

        if ( $this -> logo )
            $this -> createArray['logo'] = $this -> logo -> store('img/brands');

        Brand::create( $this -> createArray );

        $this -> reset('createArray');
        $this -> emit('saved');
    }

    public function edit(Brand $brand)
    {
        $this -> reset(['logoEdit']);
        $this -> resetValidation();

        $this -> brand = $brand;

        $this -> editArray['name'] = $brand -> name;
        $this -> editArray['logo'] = $brand -> logo;
        $this -> editArray['featured'] = $brand -> featured;
    }

    public function update()
    {
        $this -> validate([
            'editArray.name' => 'required',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:4096'
        ]);

        if ( $this -> logoEdit ){
            Storage::disk('public') -> delete($this -> brand -> logo);
            $this -> editArray['logo'] = $this -> logoEdit -> store('img/brands');
        }

        $this -> brand -> update( $this -> editArray );
        $this -> emit('updated');
    }

    public function destroy(Brand $brand)
    {
        Storage::disk('public') -> delete( $brand -> logo );
        $brand -> delete();
        $this -> emit('deleted');
    }

    public function render()
    {
        $brands = Brand::orderBy('name') -> get();
        return view('livewire.admin.brand-component', compact('brands'));
    }
}
