<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Setting;

class ShopLayout extends Component
{
    protected $shop;

    public function __construct($shop)
    {
        $this -> shop = $shop;
    }

    public function render()
    {
        $shop = Shop::where('slug', $this -> shop) -> first();
        $categoriesShop = json_decode($shop -> categories, true);
        $categories = Category::whereIn('id', $categoriesShop) -> where('parent_id', NULL) -> orderBy('name') -> get();
        $settings = Setting::first();
        $shop_url = url('/') . '/' . $shop -> slug;

        return view('layouts.shop', compact('shop', 'categories', 'settings', 'shop_url'));
    }
}
