<?php

namespace App\Http\Livewire\Panel;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Notifications\NewRequestDomain;
use App\Models\User;

class Domain extends Component
{

    public $domain, $domain_status, $domain_name, $extension, $domain_result_status;

    public function mount()
    {
        $this -> domain_status = Auth::user() -> shop -> domain_status;
    }

    public function saveDomain()
    {
        $this -> validate([
            'domain_result_status' => 'required|accepted'
        ]);

        Auth::user() -> shop -> domain = $this -> domain_name . $this -> extension;
        Auth::user() -> shop -> domain_status = 2;
        Auth::user() -> shop -> save();

        $admins = User::where('user_type', 1) -> get();
        foreach ($admins as $admin) {
            $admin -> notify( new NewRequestDomain(Auth::user() -> shop) );
        }

        $this -> domain_status = 2;
        $this -> emit('updated');
    }

    public function render()
    {
        return view('livewire.panel.domain');
    }
}
