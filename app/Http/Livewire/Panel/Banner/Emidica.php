<?php

namespace App\Http\Livewire\Panel\Banner;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Banner;

class Emidica extends Component
{
    public $bannerAdmin = array();

    public function mount()
    {
        if ( Auth::user() -> shop -> banners ) {
            $bannersAdmin = json_decode(Auth::user() -> shop -> banners);
            foreach ($bannersAdmin as $bannerAdmin) {
                if ( $bannerAdmin )
                    $this -> bannerAdmin[$bannerAdmin] = $bannerAdmin;
            }
        }
    }

    public function saveBannersAdmin()
    {
        $array = array();
        if ( $this -> bannerAdmin ) {
            foreach ($this -> bannerAdmin as $bannerAdmin) {
                if ( $bannerAdmin )
                    $array[] = $bannerAdmin;
            }
        }

        $baSelected = json_encode($array, JSON_FORCE_OBJECT);

        Auth::user() -> shop -> banners = $baSelected;
        Auth::user() -> shop -> save();

        $this -> emit('updated');
    }

    public function render()
    {
        $bannersAdmin = Banner::orderBy('id', 'DESC') -> whereLocation(1) -> whereStatus(1) -> get();
        return view('livewire.panel.banner.emidica', compact('bannersAdmin'));
    }
}
