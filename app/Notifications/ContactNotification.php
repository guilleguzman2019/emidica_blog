<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactNotification extends Notification
{
    use Queueable;

    protected $name;
    protected $email;
    protected $phone;
    protected $message;

    public function __construct($name, $email, $phone, $message)
    {
        $this -> name = $name;
        $this -> email = $email;
        $this -> phone = $phone;
        $this -> message = $message;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from($this -> email, $this -> name)
                    ->subject('Nuevo mensaje de contacto')
                    ->line('De: ' . $this -> name)
                    ->line('Email: ' . $this -> email)
                    ->line('Teléfono: ' . $this -> phone)
                    ->line('Mensaje: ' . $this -> message);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
