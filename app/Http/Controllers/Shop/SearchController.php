<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Shop;
use App\Models\Category;

class SearchController extends Controller
{
    public function __invoke(Shop $shop, Request $request)
    {
        if ( ! $shop -> user ) { abort(404); }

        $categoriesShop = json_decode($shop -> categories, true);
        $settings = Setting::first();
        $q = $request -> q;
        $products = Product::search( $q )
                          -> whereIn('category_id', $categoriesShop)
                          -> where('status', 2)
                          -> where('quantity', '>', 0)
                          -> paginate(20);

        return view('shop.products.search', compact('shop', 'settings', 'products', 'q'));
    }
}
