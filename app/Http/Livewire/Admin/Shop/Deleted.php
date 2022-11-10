<?php

namespace App\Http\Livewire\Admin\Shop;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Deleted extends Component
{
    use WithPagination;

    public $search, $paginate = 20;

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');
    }

    public function updatedSearch()
    {
        $this -> resetPage();
    }

    public function render()
    {
        $paginate = $this -> paginate;

        $shops = User::search( $this -> search )
                    -> orderBy('id', 'DESC')
                    -> onlyTrashed()
                    -> paginate($paginate);

        return view('livewire.admin.shop.deleted', compact('shops'));
    }
}
