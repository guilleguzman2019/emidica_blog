<?php

namespace App\Http\Livewire\Shop\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Setting;

class Index extends Component
{
    public $shop, $settings, $descendantsIds, $order, $perPage = 120;

    protected $listeners = ['morePages'];

    public function updatedOrder()
    {
        $this -> reset('perPage');
    }

    public function morePages()
    {
        $this -> perPage += 120;
    }

    public function render()
    {
        $order = $this -> order ?? 'name,asc';
        $orderBy = explode(',', $order);

        $products = Product::whereIn('category_id', $this -> descendantsIds)
                          -> where('status', 2)
                          -> where('quantity', '>', 0)
                          -> order( $orderBy[0], $orderBy[1] )
                          -> paginate($this -> perPage);

        return view('livewire.shop.product.index', compact('products', 'order'));
    }
}
