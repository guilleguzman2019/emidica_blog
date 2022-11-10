<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeletedAccountNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $finance;

    public function __construct($user, $finance)
    {
        $this -> user = $user;
        $this -> finance = $finance;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject('Cuenta eliminada')
                ->greeting('¡Hola ' . $this -> finance -> name . '!')
                ->line('La tienda ' . $this -> user -> shop -> shop_name . ' ha cancelado su cuenta.');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
