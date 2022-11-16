<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Shop;
use Gloudemans\Shoppingcart\Facades\Cart;

Route::get('redirects', function ()
{
    if ( Auth::user() -> user_type != 4 )
        return redirect() -> route('admin.dashboard');
    else
        return redirect() -> route('panel.dashboard');

}) -> name('redirects');


Route::get('/', Controllers\IndexController::class);
Route::post('/webhooks_suscriptions', Controllers\WebhookController::class);

//BLOG

Route::get('/blog', function () {
    return view('blog');
});

//Route::get('/blog', [Controllers\HomeController::class, 'index'])->name('blog');
Route::get('/blog/{entrada}', [Controllers\HomeController::class, 'post'])->name('blog');

Route::get('/category/{category_slug?}', [Controllers\HomeController::class, 'category'])->name('home.category');

Route::get('/tag/{tag}', [Controllers\HomeController::class, 'tag'])->name('home.tag');



Route::get('/{shop}', [Shop\ShopController::class, 'index']) -> name('shop.index');

//PRODUCTS
Route::get('/{shop}/productos/mas-vendidos', [Shop\ProductController::class, 'mostSold']) -> name('shop.products.mostSold');
Route::get('/{shop}/productos/ultimos', [Shop\ProductController::class, 'latest']) -> name('shop.products.latest');
Route::get('/{shop}/productos/ofertas', [Shop\ProductController::class, 'sales']) -> name('shop.products.sales');
Route::get('/{shop}/productos/destacados', [Shop\ProductController::class, 'featured']) -> name('shop.products.featured');
Route::get('/{shop}/productos/{category}', [Shop\ProductController::class, 'index']) -> name('shop.products.index');
Route::get('/{shop}/producto/{product}', [Shop\ProductController::class, 'show']) -> name('shop.products.show');

//ORDERS
Route::get('/{shop}/carrito', [Shop\ShopController::class, 'cart']) -> name('shop.cart');
Route::get('/{shop}/orden/crear', [Shop\OrderController::class, 'create']) -> name('shop.order.create');
Route::post('/{shop}/orden/guardar', [Shop\OrderController::class, 'save']) -> name('shop.order.save');
Route::get('/{shop}/orden/detalle/{token}', [Shop\OrderController::class, 'show']) -> name('shop.order.show');


Route::get('/{shop}/categorias', [Shop\ShopController::class, 'categories']) -> name('shop.categories.index');

Route::get('/{shop}/tag/{tag}', [Shop\ShopController::class, 'tags']) -> name('shop.tags.index');

Route::get('/{shop}/contacto', [Shop\ShopController::class, 'contact']) -> name('shop.contact');

Route::get('/{shop}/buscar', Shop\SearchController::class) -> name('shop.search');

//payment controls
Route::get('{shop}/check-payment/{token}/{status}', [Shop\OrderController::class, 'checkPayment']) -> name('checkPayment');
Route::post('{shop}/webhooks', Shop\WebhookController::class);


