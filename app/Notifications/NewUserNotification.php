<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
    use Queueable;

    protected $name;
    protected $email;
    protected $password;

    public function __construct($name, $email, $password)
    {
        $this -> name = $name;
        $this -> email = $email;
        $this -> password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Alta de cuenta')
                    ->greeting('¡Hola ' . $this -> name . '!')
                    ->line('Hemos creado una cuenta para ti. Puedes acceder con los siguientes datos:')
                    ->line('Usuario: **' . $this -> email .'** / Contraseña: **' . $this -> password . '**')
                    ->action('Acceder', url('/login'))
                    ->line('Gracias por ser parte!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
