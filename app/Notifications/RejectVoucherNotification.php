<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RejectVoucherNotification extends Notification
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
                ->subject('Comprobante eliminado')
                ->greeting('¡Hola ' . $this -> userName . '!')
                ->line('Un ejecutivo de cuentas ha eliminado tu compobante de pago de suscripción.')
                ->line('El motivo por el cual fue eliminado es:')
                ->line('**' . $this -> motive . '**.');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
