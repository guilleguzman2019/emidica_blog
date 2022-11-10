<?php

namespace App\Http\Livewire\Panel\Shipping;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Shipping;

class Index extends Component
{
    use WithPagination;

    public $status, $paginate = 20;

    public function render()
    {
        $shippings = Shipping::where('shop_id', Auth::user() -> shop -> id)
                            -> orderBy('id', 'DESC')
                            -> paginate($this -> paginate);

        return view('livewire.panel.shipping.index', compact('shippings'));
    }
}
