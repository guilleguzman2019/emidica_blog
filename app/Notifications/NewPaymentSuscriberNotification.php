<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPaymentSuscriberNotification extends Notification
{
    use Queueable;
    protected $username;
    protected $shopname;
    protected $slug;
    
    public function __construct($username, $shopname, $slug)
    {
        $this -> username = $username;
        $this -> shopname = $shopname;
        $this -> slug = $slug;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    -> subject('Nuevo pago de suscriptor')
                    -> greeting('¡Hola!')
                    -> line('El usuario **' . $this -> username . '** de la tienda **' . $this -> shopname . '** realizó el pago de la suscripción.')
                    -> action('Acceder', route('admin.shops.show', $this -> slug));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
