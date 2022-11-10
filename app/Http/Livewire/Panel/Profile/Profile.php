<?php

namespace App\Http\Livewire\Panel\Profile;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $photo, $profile_photo_path, $name, $birthdate, $email;

    public function mount()
    {
        $this -> profile_photo_path = Auth::user() -> profile_photo_path;
        $this -> name = Auth::user() -> name;
        $this -> email = Auth::user() -> email;
        $this -> birthdate = Auth::user() -> suscriber -> birthdate ? Auth::user() -> suscriber -> birthdate -> format('Y-m-d') : '';
    }

    public function saveProfile()
    {
        $this -> validate([
            'name' => 'required',
            'birthdate' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user() -> id,
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:4096'
        ]);

        if ( $this -> photo ) {
            Storage::disk('public') -> delete(Auth::user() -> profile_photo_path);
            Auth::user() -> profile_photo_path = $this -> photo -> store('img/profile');
        }

        Auth::user() -> name = $this -> name;
        Auth::user() -> email = $this -> email;
        Auth::user() -> suscriber -> birthdate = $this -> birthdate;
        Auth::user() -> suscriber -> save();
        Auth::user() -> save();

        $this -> emit('updated');
    }

    public function render()
    {
        return view('livewire.panel.profile.profile');
    }
}
