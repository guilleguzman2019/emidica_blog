<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShippingRequestNotification extends Notification
{
    use Queueable;

    protected $shopName;

    public function __construct($shopName)
    {
        $this -> shopName = $shopName;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Nueva solicitud de envío')
                    ->greeting('¡Hola!')
                    ->line('La tienda ' . $this -> shopName . ' ha creado una nueva solicitud de envío.')
                    ->action('Ver solicitudes', route('login'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
