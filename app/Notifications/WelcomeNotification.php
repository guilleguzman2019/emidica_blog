<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    protected $username;

    public function __construct( $username )
    {
        $this -> username = $username;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Bienvenido a Emidica')
                    ->greeting('¡Hola ' . $this -> username . '!')
                    ->line('Te damos la bienvenida a Emidica, el lugar donde tener un tienda es real.')
                    ->line('Para comenzar a vender, necesitás abonar tu suscripción. Accede a tu cuenta para completar el proceso de suscripción y empezar a vender!')
                    ->action('Acceder ahora', route('login'))
                    ->line('¡Gracias por ser parte!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
