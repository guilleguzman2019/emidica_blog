<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRequestDomain extends Notification
{
    use Queueable;

    public $shop;

    public function __construct($shop)
    {
        $this -> shop = $shop;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    -> subject('Nueva solicitud de dominio')
                    -> greeting('¡Hola!')
                    -> line('El usuario **' . $this -> shop -> user -> name . '** de la tienda **' . $this -> shop -> shop_name . '** realizó la solicitud del dominio **' . $this -> shop -> domain . '**.')
                    -> action('Acceder', route('admin.shops.show', $this -> shop));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
