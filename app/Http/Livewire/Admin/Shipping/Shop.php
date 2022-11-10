<?php

namespace App\Http\Livewire\Admin\Shipping;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Shop as Market;
use App\Models\Shipping;

class Shop extends Component
{
    public $shop, $status, $search, $paginate = 20;

    public function mount(Market $shop)
    {
        $this -> shop = $shop;
    }

    public function render()
    {
        if ( Auth::user() -> user_type == 6 )
            $status = 3;
        elseif ( Auth::user() -> user_type == 7 )
            $status = 4;
        else
            $status = $this -> status;

        $shippings = Shipping::search( $this -> search )
                            -> status( $status )
                            -> where('shop_id', $this -> shop -> id)
                            -> orderBy('status')
                            -> orderBy('created_at')
                            -> paginate( $this -> paginate );

        return view('livewire.admin.shipping.shop', compact('shippings'));
    }
}
