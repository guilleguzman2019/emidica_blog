<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;
use App\Models\Product;
use App\Models\Setting;

class Search extends Component
{
    public $shop, $search;

    public function render()
    {
        $categoriesShop = json_decode($this -> shop -> categories, true);

        $products = Product::search( $this -> search )
                          -> where('status', 2)
                          -> where('quantity', '>', 0)
                          -> whereIn('category_id', $categoriesShop)
                          -> inRandomOrder()
                          -> skip(0)
                          -> take(15)
                          -> get();

        $settings = Setting::first();

        return view('livewire.shop.search', compact('products', 'settings'));
    }
}
