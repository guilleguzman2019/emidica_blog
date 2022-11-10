<?php

namespace App\Http\Livewire\Shop\Cart;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart as ShoppingCart;

class Cart extends Component
{
    public $shop;
    protected $listeners = ['render'];

    public function destroy( $value )
    {
        ShoppingCart::remove( $value );
        $this -> emit('render');
    }

    public function render()
    {
        return view('livewire.shop.cart.cart');
    }
}
