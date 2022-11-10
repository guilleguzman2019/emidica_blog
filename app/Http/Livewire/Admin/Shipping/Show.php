<?php

namespace App\Http\Livewire\Admin\Shipping;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Notifications\DeleteVoucherNotification;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Shipping;

class Show extends Component
{

    public $shipping, $ticket, $motive, $trackingCode;

    protected $listeners = ['render', 'countTickets'];

    public function mount(Shipping $shipping)
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');

        $this -> shipping = $shipping;
    }

    public function discountShipping()
    {
        $this -> shipping -> total = $this -> shipping -> subtotal;
        $this -> shipping -> shipping_cost = NULL;
        $this -> shipping -> save();

        $this -> emit('updated');
    }

    public function deleteTicket(Ticket $ticket)
    {
        $this -> ticket = $ticket;
    }

    public function destroyTicket()
    {
        Storage::disk('public') -> delete($this -> ticket -> ticket);
        $this -> ticket -> delete();
        $this -> shipping -> shop -> user -> notify( new DeleteVoucherNotification($this -> shipping -> shop -> user -> name, $this -> shipping -> id, $this -> motive) );

        $this -> emit('deleted');
    }

    public function countTickets()
    {
        if ( ! $this -> shipping -> tickets -> count() ) {
            $this -> shipping -> status = Shipping::PENDING;
            $this -> shipping -> save();
        }

        $this -> emit('render');
    }

    public function approve()
    {
        $this -> shipping -> update([ 'status' => 3 ]);

        foreach ($this -> shipping -> orders as $order) {
            $order -> status = Order::REQUEST_SHIPPING_APPROVE;
            $order -> save();
        }

        $this -> emit('updated');
    }

    public function takeOrders()
    {
        $this -> shipping -> responsable_id = Auth::user() -> id;
        $this -> shipping -> save();

        foreach ($this -> shipping -> orders as $order) {
            $order -> responsable_id = Auth::user() -> id;
            $order -> save();
        }

        $this -> emit('updated');
    }

    public function ordersEnded()
    {
        $this -> shipping -> status = 4;
        $this -> shipping -> save();

        foreach ($this -> shipping -> orders as $order) {
            $order -> status = 8;
            $order -> save();
        }

        $this -> emit('updated');
    }

    public function ordersSent()
    {
        if ( $this -> trackingCode ) {
            foreach ($this -> trackingCode as $key => $value) {
                $ordr = Order::find($key);
                $ordr -> tracking_code = $value;
                $ordr -> save();
            }
        }

        $this -> shipping -> status = 5;
        $this -> shipping -> save();

        foreach ($this -> shipping -> orders as $order) {
            $order -> status = 9;
            $order -> save();
        }

        $this -> emit('updated');
    }

    public function destroy()
    {
        foreach ($this -> shipping -> tickets as $ticket) {
            Storage::disk('public') -> delete( $ticket -> ticket );
        }
        foreach ($this -> shipping -> orders as $order) {
            $order -> status = Order::PAYED;
            $order -> save();
        }

        $this -> shipping -> delete();

        return redirect() -> route('admin.shippings');
    }

    public function render()
    {
        $orders = Order::where('shipping_id', $this -> shipping -> id) -> get();
        return view('livewire.admin.shipping.show', compact('orders'));
    }
}
