<?php

namespace App\Http\Livewire\Landing;

use Livewire\Component;
use App\Notifications\ContactEmidicaNotification;
use Illuminate\Support\Facades\Notification;

class ContactForm extends Component
{
    public $name, $email, $phone, $subject, $message, $response = false;

    public function sendContact()
    {
        $this -> validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Notification::route('mail', 'info@emidica.com') -> notify( new ContactEmidicaNotification( $this -> name, $this -> email, $this -> phone, $this -> subject, $this -> message ) );

        $this -> reset(['name', 'email', 'phone', 'subject', 'message']);
        $this -> response = true;
    }

    public function render()
    {
        return view('livewire.landing.contact-form');
    }
}
