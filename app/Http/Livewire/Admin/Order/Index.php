<?php

namespace App\Http\Livewire\Admin\Order;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Shop;

class Index extends Component
{
    use WithPagination;

    public $status, $search, $paginate = 20;

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');
    }

    public function render()
    {
        $shops = Shop::search( $this -> search )
                    -> statusOrder( $this -> status )
                    -> whereHas('orders', function(Builder $query) {
                        $query -> where('shop_id', '!=', NULL) -> orderBy('created_at');
                    })
                    -> paginate( $this -> paginate );

        return view('livewire.admin.order.index', compact('shops'));
    }
}
