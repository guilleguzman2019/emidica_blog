<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\ProductSize as Size;

class ProductSize extends Component
{
    public $product, $name, $quantity, $variant, $editArray = [];

    protected $listeners = ['render'];

    public function save()
    {
        //valido campos
        $this -> validate([
            'name' => 'required',
            'quantity' => 'required'
        ]);

        $ifSize = Size::where('name', $this -> name) -> where('product_id', $this -> product -> id) -> first();

        if ( $ifSize ) {

            $ifSize -> update([ 'quantity' => $this -> quantity + $ifSize -> quantity ]);

        } else{

            Size::create([
                'name' => $this -> name,
                'quantity' => $this -> quantity,
                'product_id' => $this -> product -> id
            ]);
        }

        //elimino cantidad de otras variaciones
        if ( $this -> product -> color ) {
            foreach ($this -> product -> color as $color) { $color -> delete(); }
        }
        $this -> product -> quantity = $this -> product -> sizes -> sum('quantity') + $this -> quantity;
        $this -> product -> save();

        $this -> reset(['name', 'quantity']);
        $this -> emit('added');
    }

    public function edit(Size $size)
    {
        $this -> variant = $size;
        $this -> editArray = [
            'name' => $size -> name,
            'quantity' => $size -> quantity
        ];
    }

    public function update()
    {
        $this -> validate([
            'editArray.name' => 'required',
            'editArray.quantity' => 'required'
        ]);

        $this -> variant -> update( $this -> editArray );

        $this -> product -> quantity = $this -> product -> sizes -> sum('quantity');
        $this -> product -> save();

        $this -> emit('saved');
    }

    public function destroy(Size $size)
    {
        $this -> product -> quantity = $this -> product -> sizes -> sum('quantity') - $size -> quantity;
        $this -> product -> save();

        $size -> delete();

        $this -> emit('deleted');
    }

    public function render()
    {
        $sizes = $this -> product -> sizes;
        return view('livewire.admin.product.product-size', compact('sizes'));
    }
}
