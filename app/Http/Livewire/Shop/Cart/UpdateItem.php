<?php

namespace App\Http\Livewire\Shop\Cart;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;

class UpdateItem extends Component
{

    public $rowId, $quantity, $shop;

    public function mount()
    {
        $item = Cart::get($this -> rowId);
        $this -> quantity = $item -> qty;
    }

    public function less()
    {
        $this -> quantity = $this -> quantity - 1;
        if ( $this -> quantity == 0 ) {
            Cart::remove( $this -> rowId );
        } else {
            Cart::update($this -> rowId, $this -> quantity);
        }

        $this -> emit('render');
    }

    public function plus()
    {
        $quantity = $this -> quantity + 1;
        $item = Cart::get($this -> rowId);
        $product = Product::find($item -> id);

        if ( $product -> variation == 1 ) {
            if ( $quantity <= $product -> quantity) {
                $this -> quantity = $quantity;
                Cart::update($this -> rowId, $this -> quantity);
                $this -> emit('render');
            } else {
                $this -> emit('notStock');
            }
        }

        if ( $product -> variation == 3 ) {
            if ( $quantity <= $product -> sizes -> where('id', $item -> options -> size_id) -> first() -> quantity) {
                $this -> quantity = $quantity;
                Cart::update($this -> rowId, $this -> quantity);
                $this -> emit('render');
            } else {
                $this -> emit('notStock');
            }
        }
    }

    public function render()
    {
        return view('livewire.shop.cart.update-item');
    }
}
