<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderSent extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this -> order = $order
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Pedido enviado')
                    ->greeting('¡Hola ' . $this -> order -> customer_name . '!')
                    ->line('Tu pedido ya está en camino. Para conocer el estado, ingresá al detalle de tu pedido.')
                    ->action('Ver pedido', route('shop.order.show', [$this -> order -> shop, $this -> order -> token]))
                    ->line('¡Gracias por tu compra!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
