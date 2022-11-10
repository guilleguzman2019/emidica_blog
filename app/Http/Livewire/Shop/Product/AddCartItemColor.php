<?php

namespace App\Http\Livewire\Shop\Product;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Setting;

class AddCartItemColor extends Component
{
    public $shop, $product, $max, $color = NULL, $quantity = 1, $options = [];

    public function updatedColor()
    {
        $this -> max = $this -> product -> colors -> where('id', $this -> color) -> first();
    }

    public function plus()
    {
        if ( $this -> quantity < $this -> max -> quantity ) {
            $this -> quantity = $this -> quantity + 1;
        }
    }

    public function less()
    {
        if ( $this -> quantity > 1 ) {
            $this -> quantity = $this -> quantity - 1;
        }
    }

    public function addItem()
    {
        $settings = Setting::first();

        //Precio
        $price = '';
        $price_regular = (($this -> product -> price_cost * $settings -> dolar) * $this -> product -> price_regular / 100) + ($this -> product -> price_cost * $settings -> dolar);
        if ( $this -> product -> price_sale ) :
            $price = $price_regular - ($price_regular * $this -> product -> price_sale/100);
        else :
            $price = $price_regular;
        endif;

        $this -> options['image'] = $this -> product -> image ?? 'img/shop/default.png';
        $this -> options['sku'] = $this -> product -> sku;
        $this -> options['price_cost_usd'] = $this -> product -> price_cost;
        $this -> options['price_cost_ars'] = $this -> product -> price_cost * $settings -> dolar;
        $this -> options['price_regular'] = $price_regular;
        if ( $this -> product -> price_sale ) {
            $this -> options['price_sale'] = $price_regular - ($price_regular * $this -> product -> price_sale/100);
        }
        $this -> options['color_id'] = $this -> color;
        $this -> options['color_name'] = $this -> max -> name;

        $itemAdded = Cart::add([
            'id' => $this -> product -> id,
            'name' => $this -> product -> name,
            'qty' => $this -> quantity,
            'price' => $price,
            'weight' => $this -> product -> weight ?? 0,
            'options' => $this -> options
        ]);

        if ( $this -> max -> quantity < $itemAdded -> qty ) {
            Cart::update($itemAdded -> rowId, $itemAdded -> qty - $this -> quantity);
            $this -> emit('notStock');
        } else {
            $this -> emit('added');
        }

        $this -> reset('quantity');
        $this -> emitTo('shop.cart-icon', 'render', [$this -> shop]);
    }

    public function render()
    {
        return view('livewire.shop.product.add-cart-item-color');
    }
}
