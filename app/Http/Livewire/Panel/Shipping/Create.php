<?php

namespace App\Http\Livewire\Panel\Shipping;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\User;
use App\Notifications\ShippingRequestNotification;

class Create extends Component
{
    public $ordersSelected = [], $sumaTotal = 0, $sumaCost = 0, $realCost = 0, $shipping = false, $cost = 0, $selected, $settings;

    public function mount()
    {
        $this -> settings = Setting::first();
    }

    public function updatedOrdersSelected()
    {
        $this -> reset(['sumaTotal', 'sumaCost', 'shipping', 'cost', 'realCost']);

        foreach ($this -> ordersSelected as $id => $os) {
            if ( $os ) {
                $values = explode(',', $os);

                $this -> sumaTotal = $this -> sumaTotal + $values[0];
                $this -> sumaCost = $this -> sumaCost + $values[1];
                $this -> realCost = $this -> realCost + $values[2];
                $this -> cost = $this -> sumaCost;

                $order = Order::find($id);
                if ( $order -> shipping_type == 1 ) {
                    $this -> shipping = true;
                }
            }
        }

        if ( $this -> shipping ) {
            $this -> sumaCost = $this -> sumaCost + $this -> settings -> shipping;
        }
    }

    public function shippingRequest()
    {
        foreach ($this -> ordersSelected as $id => $os) {
            if ( $os ) {
                $this -> selected = 1;
            } else {
                $this -> selected = NULL;
            }
        }

        $this -> validate([
            'selected' => 'required'
        ]);

        $shipping = Shipping::create([
            'status' => 1,
            'subtotal' =>  $this -> cost,
            'shipping_cost' => ($this -> shipping ? $this -> settings -> shipping : NULL),
            'total' => $this -> sumaCost,
            'shop_id' => Auth::user() -> shop -> id,
        ]);

        foreach ($this -> ordersSelected as $id => $os) {
            $order = Order::find( $id );
            $order -> status = Order::REQUEST_SHIPPING;
            $order -> shipping_id = $shipping -> id;
            $order -> save();
        }

        $admins = User::where('user_type', User::ADMIN) -> get();
        $finances = User::where('user_type', User::FINANCE) -> get();
        foreach ($admins as $admin) {
            $admin -> notify( new ShippingRequestNotification(Auth::user() -> shop -> shop_name) );
        }
        foreach ($finances as $finance) {
            $finance -> notify( new ShippingRequestNotification(Auth::user() -> shop -> shop_name) );
        }

        return redirect() -> route('panel.shippings.show', $shipping);
    }

    public function render()
    {
        $orders = Order::where('shop_id', Auth::user() -> shop -> id) -> where('status', Order::PAYED) -> whereNull('shipping_id') -> get();
        return view('livewire.panel.shipping.create', compact('orders'));
    }
}
