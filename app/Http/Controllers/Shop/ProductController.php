<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Category;
use App\Models\Setting;

class ProductController extends Controller
{
    public function index(Request $request, Shop $shop, Category $category)
    {
        if ( ! $shop -> user ) { abort(404); }

        $categoriesShop = json_decode($shop -> categories, true);
        $categories = Category::whereIn('id', $categoriesShop) -> where('parent_id', NULL) -> orderBy('name') -> get();

        //aborto en caso que la categoría seleccionada no la venda la tienda
        if ( ! in_array($category -> id, $categoriesShop) ) abort(404);

        $parents[] = $category -> id;
        foreach ($category -> getAscendantsAttribute()  as $parent) {
            $parents[] = $parent -> id;
        }

        $selectedCategory = $category;
        $categoriaTop = Category::where('slug', $category -> slug) -> first();

        $descendantsIds = $categoriaTop -> descendants -> pipe(function ( $collection ) use ($category) {
            $array = $collection -> toArray();
            $ids[] = $category -> id;
            array_walk_recursive( $array, function ($value, $key) use (& $ids) {
                if ( $key === 'id' ) {
                    $ids[] = $value;
                };
            });
            return $ids;
        });

        $settings = Setting::first();

        $order = $request -> order ?? 'name,asc';
        $orderBy = explode(',', $request -> order ?? 'name,asc');

        $products = Product::whereIn('category_id', $descendantsIds)
                          -> where('status', 2)
                          -> where('quantity', '>', 0)
                          -> order( $orderBy[0], $orderBy[1] )
                          -> paginate(48);

        return view('shop.products.index', compact('shop', 'category', 'categories', 'parents', 'selectedCategory', 'order', 'products', 'settings', 'categoriaTop', 'descendantsIds'));
    }

    public function show(Shop $shop, Product $product)
    {

        if ( ! $shop -> user ) { abort(404); }

        $categoriesShop = json_decode($shop -> categories, true);

        //aborto en caso que la categoría del producto no la venda la tienda
        if ( ! in_array($product -> category_id, $categoriesShop)) abort(404);

        //guardo la visualizacion
        $product -> views = $product -> views + 1;
        $product -> save();

        $setting = Setting::first();


        //busco si tiene categoría superior para buscar relacionados
        $parent = $product -> category -> getAscendantsAttribute() -> first();

        $children[] = $product -> category_id;
        if ( $parent ) :
            $children[] = $parent -> id;

            foreach ($parent -> descendants as $descendants) {
                $children[] = $descendants -> id;
            }
        endif;

        //busco las categorias inferiores
        foreach ($product -> category -> descendants as $sc) {
            $children[] = $sc -> id;

            foreach ($sc -> descendants as $sc2) {
                $children[] = $sc2 -> id;

                foreach ($sc2 -> descendants as $sc3) {
                    $children[] = $sc3 -> id;

                    foreach ($sc3 -> descendants as $sc4) {
                        $children[] = $sc4 -> id;

                        foreach ($sc4 -> descendants as $sc5) {
                            $children[] = $sc5 -> id;

                            foreach ($sc5 -> descendants as $sc6) {
                                $children[] = $sc6 -> id;

                                foreach ($sc6 -> descendants as $sc7) {
                                    $children[] = $sc7 -> id;

                                    foreach ($sc7 -> descendants as $sc8) {
                                        $children[] = $sc8 -> id;

                                        foreach ($sc8 -> descendants as $sc9) {
                                            $children[] = $sc9 -> id;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $related = Product::whereIn('category_id', $children) -> whereNotIn('id', [$product -> id]) -> where('status', 2) -> inRandomOrder() -> limit(4) -> get();

        return view('shop.products.show', compact('shop', 'product', 'setting', 'related'));

    }

    public function mostSold(Shop $shop)
    {
        if ( ! $shop -> user ) { abort(404); }

        $settings = Setting::first();

        //categorías que vende la tienda
        $categoriesShop = json_decode($shop -> categories, true);

        $products = Product::where('status', 2)
                          -> where('quantity', '>', 0)
                          -> whereIn('category_id', $categoriesShop)
                          -> skip(0)
                          -> take(60)
                          -> orderBy('views', 'DESC')
                          -> paginate(20);

        $title = 'Productos más vendidos';

        return view('shop.products.viewLists', compact('shop', 'settings', 'products', 'title'));
    }

    public function latest(Shop $shop)
    {
        if ( ! $shop -> user ) { abort(404); }

        $settings = Setting::first();

        //categorías que vende la tienda
        $categoriesShop = json_decode($shop -> categories, true);

        $products = Product::where('status', 2)
                          -> where('quantity', '>', 0)
                          -> whereIn('category_id', $categoriesShop)
                          -> skip(0)
                          -> take(60)
                          -> orderBy('created_at', 'DESC')
                          -> paginate(20);

        $title = 'Últimos Productos';

        return view('shop.products.viewLists', compact('shop', 'settings', 'products', 'title'));
    }

    public function sales(Shop $shop)
    {
        if ( ! $shop -> user ) { abort(404); }

        $settings = Setting::first();

        //categorías que vende la tienda
        $categoriesShop = json_decode($shop -> categories, true);

        $products = Product::where('status', 2)
                          -> where('quantity', '>', 0)
                          -> where('price_sale', '!=', NULL)
                          -> whereIn('category_id', $categoriesShop)
                          -> skip(0)
                          -> take(60)
                          -> orderBy('created_at', 'DESC')
                          -> paginate(20);

        $title = 'Ofertas';

        return view('shop.products.viewLists', compact('shop', 'settings', 'products', 'title'));
    }

    public function featured(Shop $shop)
    {
        if ( ! $shop -> user ) { abort(404); }

        $settings = Setting::first();

        //categorías que vende la tienda
        $categoriesShop = json_decode($shop -> categories, true);

        $products = Product::where('status', 2)
                          -> where('quantity', '>', 0)
                          -> where('featured', 1)
                          -> whereIn('category_id', $categoriesShop)
                          -> skip(0)
                          -> take(60)
                          -> orderBy('created_at', 'DESC')
                          -> paginate(20);

        $title = 'Productos destacados';

        return view('shop.products.viewLists', compact('shop', 'settings', 'products', 'title'));
    }

}
