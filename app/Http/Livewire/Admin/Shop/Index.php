<?php

namespace App\Http\Livewire\Admin\Shop;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Shop;
use App\Models\User;
use App\Models\Suscriber;

class Index extends Component
{
    use WithPagination;

    public $search, $status, $paginate = 20;

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');
    }

    public function updatedSearch()
    {
        $this -> resetPage();
    }

    public function delete(User $user)
    {
        $user -> delete();
        $this -> resetPage();
    }

    public function udpateSuscription(Suscriber $suscriber)
    {
        $renovation_date = date('Y-m-d', strtotime($suscriber -> renovation_date . "+ 1 month"));
        $suscriber -> renovation_date = $renovation_date;
        $suscriber -> save();

        $this -> emit('updated');
    }

    public function render()
    {
        $paginate = $this -> paginate;

        $shops = Shop::search( $this -> search )
                    -> status( $this -> status )
                    -> whereHas('user', function (Builder $query) {
                        $query -> where('deleted_at', NULL);
                    })
                    -> orderBy('id', 'DESC')
                    -> paginate($paginate);

        return view('livewire.admin.shop.index', compact('shops'));
    }
}
