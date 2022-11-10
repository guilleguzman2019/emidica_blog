<?php

namespace App\Http\Livewire\Admin\Marketing;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;

class CallToActionComponent extends Component
{

    use WithFileUploads;

    public $settings, $bannerBg, $cta_status, $cta_background, $cta_title, $cta_description, $cta_button_text, $cta_button_link, $message_top;

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');

        $this -> settings = Setting::first();
        $this -> cta_title = $this -> settings -> cta_title;
        $this -> cta_description = $this -> settings -> cta_description;
        $this -> cta_button_text = $this -> settings -> cta_button_text;
        $this -> cta_button_link = $this -> settings -> cta_button_link;
        $this -> cta_background = $this -> settings -> cta_background;
        $this -> cta_status = $this -> settings -> cta_status;
        $this -> message_top = $this -> settings -> message_top;
        $this -> message_status = $this -> settings -> message_status;
    }

    public function saveBanner()
    {
        $this -> validate([
            'cta_title' => 'required',
            'cta_description' => 'required',
            'cta_button_text' => 'required',
            'cta_button_link' => 'required',
            'bannerBg' => 'nullable|image|mimes:png,jpg,jpeg|max:4096'
        ]);

        if ( $this -> bannerBg ) {
            Storage::disk('public') -> delete( $this -> cta_background );
            $this -> cta_background = $this -> bannerBg -> store('img/banners');
        }

        $this -> settings -> cta_status = $this -> cta_status;
        $this -> settings -> cta_background = $this -> cta_background;
        $this -> settings -> cta_title = $this -> cta_title;
        $this -> settings -> cta_description = $this -> cta_description;
        $this -> settings -> cta_button_text = $this -> cta_button_text;
        $this -> settings -> cta_button_link = $this -> cta_button_link;
        $this -> settings -> save();

        $this -> emit('updated');
    }

    public function saveMessage()
    {
        $this -> settings -> message_top = $this -> message_top;
        $this -> settings -> message_status = $this -> message_status;
        $this -> settings -> save();

        $this -> emit('updated');
    }

    public function render()
    {
        return view('livewire.admin.marketing.call-to-action-component');
    }

}
