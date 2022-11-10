<?php

namespace App\Http\Livewire\Panel\Order;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;

class Index extends Component
{
    use WithPagination;

    public $customer, $status, $paginate = 20;

    public function updatedCustomer()
    {
        $this -> resetPage();
    }

    public function updatedStatus()
    {
        $this -> resetPage();
    }

    public function destroy(Order $order)
    {
        $order -> status = 10;
        $order -> save();

        //restauro stock
        foreach ( $order -> products as $order_product ) {
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

            }

            $order_product -> product -> quantity = $order_product -> product -> quantity + $order_product -> quantity;
            $order_product -> product -> save();
        }

        $order -> delete();
        $this -> resetPage();
    }

    public function render()
    {
        $orders = Order::customer( $this -> customer )
                      -> status( $this -> status )
                      -> where('shop_id', Auth::user() -> shop -> id)
                      -> orderBy('id', 'DESC')
                      -> paginate( $this -> paginate );

        return view('livewire.panel.order.index', compact('orders'));
    }
}
