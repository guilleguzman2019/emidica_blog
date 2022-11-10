<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSuscriberNotification extends Notification
{
    use Queueable;

    protected $name;
    protected $email;

    public function __construct($name, $email)
    {
        $this -> name = $name;
        $this -> email = $email;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Nuevo suscriptor')
                    ->greeting('¡Hola!')
                    ->line('Se ha sumado un nuevo suscriptor al sisitema.')
                    ->line('Nombre: **' . $this -> name . '** / Email: **' . $this -> email . '**')
                    ->action('Acceder', url('/login'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
