<?php

namespace App\Http\Livewire\Admin\Marketing;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Banner;
use App\Models\Category;

class BannerComponent extends Component
{
    use WithFileUploads;

    public $banner, $image_desktop, $image_mobile, $image_desktopEdit, $image_mobileEdit;
    public $editArray = [
        'image_desktop' => null,
        'image_mobile' => null,
    ];

    public $createArray = [
        'image_desktop' => null,
        'image_mobile' => null,
        'url' => null,
        'order' => null,
        'location' => null,
        'status' => 0,
        'category_id' => null
    ];

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');
    }

    public function save()
    {
        $this -> validate([
            'image_desktop' => 'required|image|mimes:png,jpg,jpeg|max:4096',
            'image_mobile' => 'required|image|mimes:png,jpg,jpeg|max:4096',
            'createArray.location' => 'required',
            'createArray.category_id' => 'required'
        ]);

        $this -> createArray['image_desktop'] = $this -> image_desktop -> store('img/banners');
        $this -> createArray['image_mobile'] = $this -> image_mobile -> store('img/banners');

        Banner::create( $this -> createArray );

        $this -> reset('createArray', 'image_desktop', 'image_mobile');
        $this -> emit('saved');
    }

    public function edit(Banner $banner)
    {
        $this -> banner = $banner;
        $this -> editArray['image_desktop'] = $banner -> image_desktop;
        $this -> editArray['image_mobile'] = $banner -> image_mobile;
        $this -> editArray['url'] = $banner -> url;
        $this -> editArray['order'] = $banner -> order;
        $this -> editArray['location'] = $banner -> location;
        $this -> editArray['status'] = $banner -> status;
        $this -> editArray['category_id'] = $banner -> category_id;
    }

    public function update()
    {
        $this -> validate([
            'image_desktopEdit' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'image_mobileEdit' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'editArray.location' => 'required',
            'editArray.category_id' => 'required'
        ]);

        if ( $this -> image_desktopEdit ) {
            Storage::disk('public') -> delete($this -> banner -> image_desktop);
            $this -> editArray['image_desktop'] = $this -> image_desktopEdit -> store('img/banners');
        }

        if ( $this -> image_mobileEdit ) {
            Storage::disk('public') -> delete($this -> banner -> image_mobile);
            $this -> editArray['image_mobile'] = $this -> image_mobileEdit -> store('img/banners');
        }

        $this -> banner -> update( $this -> editArray );

        $this -> emit('updated');
    }

    public function destroy(Banner $banner)
    {
        Storage::disk('public') -> delete( $banner -> image_desktop );
        Storage::disk('public') -> delete( $banner -> image_mobile );
        $banner -> delete();

        $this -> emit('deleted');
    }

    public function render()
    {
        $banners = Banner::orderBy('location') -> orderBy('order') -> get();
        $categories = Category::where('parent_id', NULL) -> orderBy('name') -> get();
        return view('livewire.admin.marketing.banner-component', compact('banners', 'categories'));
    }
}
