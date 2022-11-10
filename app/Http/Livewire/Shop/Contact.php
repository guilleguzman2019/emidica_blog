<?php

namespace App\Http\Livewire\Shop;

use Notification;
use Livewire\Component;
use App\Notifications\ContactNotification;

class Contact extends Component
{

    public $shop, $name, $email, $phone, $message;

    public function mount($shop)
    {
        $this -> shop = $shop;
    }

    public function sendForm()
    {
        $this -> validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);

        Notification::route('mail', $this -> shop -> shop_mail ?? $this -> shop -> user -> email) -> notify( new ContactNotification( $this -> name, $this -> email, $this -> phone, $this -> message ) );

        $this -> reset(['name', 'email', 'phone', 'message']);
        $this -> emit('sent');
    }

    public function render()
    {
        return view('livewire.shop.contact');
    }
}
