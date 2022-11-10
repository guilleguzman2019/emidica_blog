<?php

namespace App\Http\Livewire\Admin\Order;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Order;

class Show extends Component
{

    public $order;

    public function mount(Order $order)
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');

        $this -> order = $order;
    }

    public function render()
    {
        return view('livewire.admin.order.show');
    }
}
