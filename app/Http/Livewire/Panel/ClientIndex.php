<?php

namespace App\Http\Livewire\Panel;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;

class ClientIndex extends Component
{
    use WithPagination;

    public $customer, $paginate = 20;

    public function updatedCustomer()
    {
        $this -> resetPage();
    }

    public function render()
    {
        $clients = Order::customer( $this -> customer )
                       -> where('shop_id', Auth::user() -> shop -> id)
                       -> groupBy('customer_email')
                       -> paginate( $this -> paginate );

        return view('livewire.panel.client-index', compact('clients'));
    }
}
