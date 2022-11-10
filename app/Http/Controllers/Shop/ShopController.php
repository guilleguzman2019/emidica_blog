<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Tag;

class ShopController extends Controller
{

    public function index(Shop $shop)
    {
        if ( ! $shop -> user || $shop -> user -> suscriber -> status == 4 || $shop -> user -> suscriber -> status == 5 || $shop -> user -> suscriber -> status == 6 ) { abort(404); }

        if ( $shop -> domain && $shop -> domain_status == 1 ) {
            return redirect() -> to('https://' . $shop -> domain);
        }

        $settings = Setting::first();

        $slidersAdmin = json_decode($shop -> banners, true);
        $categoriesShop = json_decode($shop -> categories, true);

        if ( $slidersAdmin ) {
            $bannersSlider = Banner::where('status', 1) -> where('location', 1) -> whereIn('id', $slidersAdmin) -> orderBy('order') -> get();
        } else {
            $bannersSlider = [];
        }
        $bannersSecondary = Banner::where('status', 1) -> where('location', 2) -> whereIn('category_id', $categoriesShop) -> orderBy('order') -> get();

        $featured = Product::where('status', 2) -> whereIn('category_id', $categoriesShop) -> where('featured', 1) -> inRandomOrder() -> skip(0) -> take(8) -> get();
        $mostSold = Product::where('status', 2) -> orderBy('sales', 'DESC') -> whereIn('category_id', $categoriesShop) -> skip(0) -> take(8) -> get();
        $lastProducts = Product::where('status', 2) -> orderBy('created_at', 'DESC') -> whereIn('category_id', $categoriesShop) -> skip(0) -> take(4) -> get();
        $sales = Product::where('status', 2) -> whereIn('category_id', $categoriesShop) -> where('price_sale', '!=', NULL) -> inRandomOrder() -> skip(0) -> take(4) -> get();

        $shop_url = url('/') . '/' . $shop -> slug;

        return view('shop.index', compact('shop', 'bannersSlider', 'bannersSecondary', 'featured', 'mostSold', 'settings', 'lastProducts', 'sales', 'shop_url'));
    }

    public function categories(Shop $shop)
    {
        if ( ! $shop -> user || $shop -> user -> suscriber -> status == 4 || $shop -> user -> suscriber -> status == 5 || $shop -> user -> suscriber -> status == 6 ) { abort(404); }

        if ( $shop -> domain && $shop -> domain_status == 1 ) {
            return redirect() -> to('https://' . $shop -> domain);
        }

        $categoriesShop = json_decode($shop -> categories, true);
        $categories = Category::whereIn('id', $categoriesShop) -> where('parent_id', NULL) -> orderBy('name') -> get();

        return view('shop.categories', compact('shop', 'categories'));
    }

    public function cart(Shop $shop)
    {
        if ( ! $shop -> user || $shop -> user -> suscriber -> status == 4 || $shop -> user -> suscriber -> status == 5 || $shop -> user -> suscriber -> status == 6 ) { abort(404); }

        if ( $shop -> domain && $shop -> domain_status == 1 ) {
            return redirect() -> to('https://' . $shop -> domain);
        }

        return view('shop.cart', compact('shop'));
    }

    public function contact(Shop $shop)
    {
        if ( ! $shop -> user || $shop -> user -> suscriber -> status == 4 || $shop -> user -> suscriber -> status == 5 || $shop -> user -> suscriber -> status == 6 ) { abort(404); }

        if ( $shop -> domain && $shop -> domain_status == 1 ) {
            return redirect() -> to('https://' . $shop -> domain);
        }

        return view('shop.contact', compact('shop'));
    }

    public function tags(Shop $shop, Tag $tag)
    {
        if ( ! $shop -> user || $shop -> user -> suscriber -> status == 4 || $shop -> user -> suscriber -> status == 5 || $shop -> user -> suscriber -> status == 6 ) { abort(404); }

        if ( $shop -> domain && $shop -> domain_status == 1 ) {
            return redirect() -> to('https://' . $shop -> domain);
        }

        $settings = Setting::first();

        $categoriesShop = json_decode($shop -> categories, true);
        $products = Product::where('status', 2)
                          -> orderBy('created_at', 'DESC')
                          -> whereIn('category_id', $categoriesShop)
                          -> whereHas('productTags', function (Builder $query) use ($tag) {
                            $query -> where('tag_id', $tag -> id);
                          })
                          -> paginate();

        return view('shop.tags', compact('shop', 'products', 'tag', 'settings'));
    }

    public function ipn(Shop $shop, $platform)
    {
        // code...
    }

}
