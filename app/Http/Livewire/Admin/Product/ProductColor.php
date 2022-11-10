<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\ProductColor as Color;

class ProductColor extends Component
{
    public $product, $color="#000000", $quantity, $variant, $editArray = [];

    protected $listeners = ['render'];

    public function save()
    {
        //valido campos
        $this -> validate([
            'color' => 'required',
            'quantity' => 'required'
        ]);


        $ifColor = Color::where('name', $this -> color) -> where('product_id', $this -> product -> id) -> first();

        if ( $ifColor ) {

            $ifColor -> update([
                'quantity' => $this -> quantity + $ifColor -> quantity
            ]);

        } else{

            Color::create([
                'name' => $this -> color,
                'quantity' => $this -> quantity,
                'product_id' => $this -> product -> id
            ]);
        }

        //elimino cantidad de variaciones
        foreach ($this -> product -> sizes as $size) { $size -> delete(); }
        $this -> product -> quantity = $this -> product -> colors -> sum('quantity') + $this -> quantity;
        $this -> product -> save();

        $this -> reset(['color', 'quantity']);
        $this -> emit('added');
    }

    public function edit(Color $color)
    {
        $this -> variant = $color;
        $this -> editArray = [
            'name' => $color -> name,
            'quantity' => $color -> quantity
        ];
    }

    public function update()
    {
        $this -> validate([
            'editArray.name' => 'required',
            'editArray.quantity' => 'required'
        ]);

        $this -> variant -> update( $this -> editArray );

        $this -> product -> quantity = $this -> product -> colors -> sum('quantity');
        $this -> product -> save();

        $this -> emit('saved');
    }

    public function destroy(Color $color)
    {
        $this -> product -> quantity = $this -> product -> colors -> sum('quantity') - $color -> quantity;
        $this -> product -> save();

        $color -> delete();
        $this -> emit('deleted');
    }

    public function render()
    {
        $colors = $this -> product -> colors;
        return view('livewire.admin.product.product-color', compact('colors'));
    }
}
