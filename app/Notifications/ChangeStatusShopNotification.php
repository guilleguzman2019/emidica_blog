<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChangeStatusShopNotification extends Notification
{
    use Queueable;

    protected $status, $motive, $user;

    public function __construct($status, $motive, $user)
    {
        $this -> status = $status;
        $this -> motive = $motive;
        $this -> user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject($this -> status)
                    ->greeting('¡Hola ' . $this -> user -> name . '!')
                    ->line('Tu tienda ' . $this -> user -> shop -> shop_name . ' a cambiado de estado a **' . $this -> status . '** por el siguiente motivo:')
                    ->line($this -> motive)
                    ->line('Si consideras que esto es un error, te pedimos que te comuniques con nosotros para poder corregirlo lo antes posible.');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
