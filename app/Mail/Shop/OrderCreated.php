<?php

namespace App\Mail\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Orden creada';

    public $order;

    public function __construct(Order $order)
    {
        $this -> order = $order;
    }

    public function build()
    {
        return $this -> from('no-reply@' . $this -> order -> shop -> slug . '.site', $this -> order -> shop -> shop_name)
                     -> view('mails.shop.order-created');
    }
}
