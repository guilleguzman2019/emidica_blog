<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNotification extends Notification
{
    use Queueable;

    private $notificacion;

    public function __construct($notificacion)
    {
        $this -> notificacion = $notificacion;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        //
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this -> notificacion['title'],
            'content' => $this -> notificacion['content'],
            'url' => $this -> notificacion['url']
        ];
    }
}
