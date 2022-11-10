<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VoucherSentNotification extends Notification
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
                    ->subject('Nuevo comprobante')
                    ->greeting('¡Hola!')
                    ->line('La tienda ' . $this -> shopName . ' ha enviado un comprobante de pago.')
                    ->action('Ver solicitudes', route('admin.shippings'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
