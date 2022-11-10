<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActiveAccountNotification extends Notification
{
    use Queueable;

    protected $user;

    public function __construct($user)
    {
        $this -> user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject('Tienda Activa')
                ->greeting('¡Hola ' . $this -> user -> name . '!')
                ->line('Hemos aprobado tu pago y tu tienda ya se encuentra activa.')
                ->line('¡Muchas gracias por ser parte de Emidica!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
