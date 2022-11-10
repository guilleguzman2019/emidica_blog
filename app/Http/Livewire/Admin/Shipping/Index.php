<?php

namespace App\Http\Livewire\Admin\Shipping;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\Shop;

class Index extends Component
{

    public $search, $status, $paginate = 20;

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');

        if ( Auth::user() -> user_type == 3 )
            $this -> status = 1;
        if ( Auth::user() -> user_type == 6 )
            $this -> status = 3;
        elseif ( Auth::user() -> user_type == 7 )
            $this -> status = 4;
    }

    public function render()
    {

        $shops = Shop::whereHas('shippings', function(Builder $query) {
                        return $query -> search( $this -> search )
                                      -> status( $this -> status)
                                      -> orderBy('status')
                                      -> orderBy('created_at');
                    })
                    -> paginate( $this -> paginate );

        return view('livewire.admin.shipping.index', compact('shops'));
    }
}
