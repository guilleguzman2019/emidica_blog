<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptDomainNotification extends Notification
{
    use Queueable;

    protected $userName;
    
    public function __construct( $userName )
    {
        $this -> userName = $userName;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject('Dominio habilitado')
                ->greeting('¡Hola ' . $this -> userName . '!')
                ->line('Hemos comprobado el dominio que elegiste y ya está configurado para que empieces a utilizar tu tienda con él.')
                ->line('Si tienes algun inconveniente, no dudes en contactarnos.');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
