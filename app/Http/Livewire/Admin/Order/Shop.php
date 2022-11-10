<?php

namespace App\Http\Livewire\Admin\Order;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Shop as Tienda;
use App\Models\Order;

class Shop extends Component
{
    use WithPagination;

    public $shop, $customer, $status, $paginate = 20;

    public function mount(Tienda $shop)
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');

        $this -> shop = $shop;
    }

    public function render()
    {
        $orders = Order::customer( $this -> customer )
                      -> status( $this -> status )
                      -> where('shop_id', $this -> shop -> id)
                      -> paginate( $this -> paginate );
        return view('livewire.admin.order.shop', compact('orders'));
    }
}
