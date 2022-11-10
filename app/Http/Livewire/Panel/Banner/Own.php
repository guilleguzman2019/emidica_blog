<?php

namespace App\Http\Livewire\Panel\Banner;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\BannerShop;

class Own extends Component
{
    use WithFileUploads;

    public $banner, $image_desktop, $image_mobile, $image_desktopEdit, $image_mobileEdit, $editArray;

    public $createArray = [
        'url' => null,
        'status' => 0
    ];

    public function save()
    {
        $this -> validate([
            'image_desktop' => 'required|image|mimes:png,jpg,jpeg|max:4096',
            'image_mobile' => 'required|image|mimes:png,jpg,jpeg|max:4096',
        ]);

        $this -> createArray['user_id'] = Auth::user() -> id;
        $this -> createArray['image_desktop'] = $this -> image_desktop -> store('img/banners');
        $this -> createArray['image_mobile'] = $this -> image_mobile -> store('img/banners');

        BannerShop::create($this -> createArray);

        $this -> reset(['createArray', 'image_desktop', 'image_mobile']);
        $this -> emit('saved');
    }

    public function edit(BannerShop $banner)
    {
        $this -> banner = $banner;
        $this -> editArray = [
            'image_desktop' => $banner -> image_desktop,
            'image_mobile' => $banner -> image_mobile,
            'url' => $banner -> url,
            'status' => $banner -> status,
        ];
    }

    public function update()
    {
        $this -> validate([
            'image_desktopEdit' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'image_mobileEdit' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
        ]);

        if ( $this -> image_desktopEdit ) {
            Storage::disk('public') -> delete( $this -> banner -> image_desktop );
            $this -> createArray['image_desktop'] = $this -> image_desktopEdit -> store('img/banners');
        }

        if ( $this -> image_mobileEdit ) {
            Storage::disk('public') -> delete( $this -> banner -> image_mobile );
            $this -> createArray['image_mobile'] = $this -> image_mobileEdit -> store('img/banners');
        }

        $this -> banner -> update( $this -> editArray );

        $this -> reset(['editArray','image_desktop', 'image_mobile']);
        $this -> emit('updated');
    }

    public function destroy(BannerShop $banner)
    {
        Storage::disk('public') -> delete( $banner -> image_desktop );
        Storage::disk('public') -> delete( $banner -> image_mobile );
        $banner -> delete();
        
        $this -> emit('deleted');
    }

    public function render()
    {
        $banners = BannerShop::where('user_id', Auth::user() -> id) -> get();
        return view('livewire.panel.banner.own', compact('banners'));
    }
}
