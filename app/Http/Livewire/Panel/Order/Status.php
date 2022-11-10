<?php

namespace App\Http\Livewire\Panel\Order;

use Livewire\Component;

class Status extends Component
{
    public $order;

    public function updateStatus($value)
    {
        $this -> order -> status = $value;
        $this -> order -> save();
        $this -> emit('updated');
    }

    public function destroy()
    {
        $this -> order -> status = 10;
        $this -> order -> save();

        //restauro stock
        foreach ( $this -> order -> products as $order_product ) {
            if ( $order_product -> variation ) {

                $variation = json_decode($order_product -> variation, true);

                //COLOR
                if ( isset( $variation['color'] ) )
                    $stock = $order_product -> product -> colors -> where('name', $variation['color']) -> first();

                //TAMAÑO
                if ( isset( $variation['size'] ) )
                    $stock = $order_product -> product -> sizes -> where('name', $variation['size']) -> first();

                $stock -> quantity = $stock -> quantity + $order_product -> quantity;
                $stock -> save();

            } else {

                $order_product -> product -> quantity = $order_product -> product -> quantity + $order_product -> quantity;
                $order_product -> product -> save();

            }
        }

        $this -> order -> delete();
        return redirect() -> route('panel.orders.index');
    }

    public function render()
    {
        $status = $this -> order -> status;
        return view('livewire.panel.order.status', compact('status'));
    }
}
