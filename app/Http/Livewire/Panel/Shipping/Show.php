<?php

namespace App\Http\Livewire\Panel\Shipping;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Notifications\VoucherSentNotification;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Shipping;
use App\Models\User;

class Show extends Component
{
    use WithFileUploads;

    public $shipping, $voucher;

    protected $listeners = ['render', 'countTickets'];

    public function mount(Shipping $shipping)
    {
        $this -> shipping = $shipping;
    }

    public function uploadVoucher()
    {
        $this -> validate([
            'voucher' => 'required|array',
            'voucher.*' => 'mimes:png,jpg,jpeg,pdf|max:2048'
        ]);

        foreach ($this -> voucher as $voucher) {
            $ticket = $voucher -> store('img/tickets');

            Ticket::create([
                'ticket' => $ticket,
                'shipping_id' => $this -> shipping -> id
            ]);
        }

        $this -> shipping -> status = Shipping::SENT_VOUCHER;
        $this -> shipping -> save();

        $admins = User::where('user_type', User::ADMIN) -> get();
        $finances = User::where('user_type', User::FINANCE) -> get();
        foreach ($admins as $admin) {
            $admin -> notify( new VoucherSentNotification(Auth::user() -> shop -> shop_name) );
        }
        foreach ($finances as $finance) {
            $finance -> notify( new VoucherSentNotification(Auth::user() -> shop -> shop_name) );
        }

        $this -> emit('uploaded');
        $this -> emit('render');
    }

    public function deleteTicket(Ticket $ticket)
    {
        Storage::disk('public') -> delete($ticket -> ticket);
        $ticket -> delete();

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

        return redirect() -> route('panel.shippings.index');
    }

    public function render()
    {
        $orders = Order::where('shipping_id', $this -> shipping -> id) -> get();
        return view('livewire.panel.shipping.show', compact('orders'));
    }
}
