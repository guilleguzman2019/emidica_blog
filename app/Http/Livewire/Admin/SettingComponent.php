<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Setting;
use App\Models\Product;

class SettingComponent extends Component
{
    public $setting, $arrayEdit = [];

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');

        $this -> setting = Setting::first();
        $this -> arrayEdit = [
            'dolar' => $this -> setting -> dolar,
            'shipping' => $this -> setting -> shipping
        ];
    }

    public function update()
    {
        $this -> validate([
            'arrayEdit.dolar' => 'required',
            'arrayEdit.shipping' => 'required'
        ]);

        $this -> setting -> update( $this -> arrayEdit );

        //MODIFICO PRECIO EN ARS A PRODUCTOS
        $products = Product::all();
        foreach ($products as $product) {

            $price_regular = (($product -> price_cost * $this -> arrayEdit['dolar']) * $product -> price_regular/100) + ($product -> price_cost * $this -> arrayEdit['dolar']);

            if ( $product -> price_sale ) :
                $price_ars = $price_regular - ($price_regular * $product -> price_sale/100);
            else:
                $price_ars = $price_regular;
            endif;

            $product -> price_ars = $price_ars;
            $product -> save();
        }


        $this -> emit('updated');
        
    }

    public function render()
    {
        return view('livewire.admin.setting-component');
    }
}
