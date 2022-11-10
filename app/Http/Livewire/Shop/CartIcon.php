<?php

namespace App\Http\Livewire\Shop;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartIcon extends Component
{

    protected $listeners = ['render'];
    public $shop;

    public function deleteItem($value)
    {
        Cart::remove( $value );
        $this -> emit('render');
    }

    public function render()
    {
        return view('livewire.shop.cart-icon');
    }
}
