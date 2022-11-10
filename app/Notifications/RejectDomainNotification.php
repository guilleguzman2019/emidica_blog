<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RejectDomainNotification extends Notification
{
    use Queueable;

    protected $userName;
    protected $motive;
    
    public function __construct( $userName, $motive )
    {
        $this -> userName = $userName;
        $this -> motive = $motive;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject('Dominio rechazado')
                ->greeting('¡Hola ' . $this -> userName . '!')
                ->line('No hemos podido validar el dominio que elegiste.')
                ->line('El motivo por el cual no fue validado es:')
                ->line('**' . $this -> motive . '**.')
                ->line('De todas formas no te preocupes, ya que no pierdes el beneficio y ya habilitamos nuevamente el buscador para que puedas elegir un dominio nuevo.')
                ->line('Te pedimos disculpas por los inconveniente que pueda haber ocacionado esta situación. Ante cualquier duda, comunicate con nuestros asistentes.');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
