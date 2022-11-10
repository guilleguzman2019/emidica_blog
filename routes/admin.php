<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Livewire\Admin as Livewire;

Route::get('dashboard', Admin\DashboarController::class) -> name('admin.dashboard');


//PRODUCTS
Route::get('productos', Livewire\Product\Index::class) -> name('admin.products.index');
Route::get('productos/agregar', Livewire\Product\Create::class) -> name('admin.products.create');
Route::get('productos/editar/{product}', Livewire\Product\Edit::class) -> name('admin.products.edit');
Route::post('productos/subir-fotos/{product}', Admin\ProductController::class) -> name('admin.products.uploadPics');
Route::get('productos/papelera', Livewire\Product\Trash::class) -> name('admin.products.trash');
Route::get('categorias', Livewire\CategoryComponent::class) -> name('admin.categories');
Route::get('etiquetas', Livewire\TagComponent::class) -> name('admin.tags');
Route::get('marcas', Livewire\BrandComponent::class) -> name('admin.brands');

//MARKETING
Route::get('call-to-actions', Livewire\Marketing\CallToActionComponent::class) -> name('admin.cta');
Route::get('banners', Livewire\Marketing\BannerComponent::class) -> name('admin.banners');

Route::get('configuracion', Livewire\SettingComponent::class) -> name('admin.settings');

//SHOPS
Route::get('tiendas', Livewire\Shop\Index::class) -> name('admin.shops.index');
Route::get('tiendas/detalle/{shop}', Livewire\Shop\Show::class) -> name('admin.shops.show');
Route::get('tiendas/eliminadas', Livewire\Shop\Deleted::class) -> name('admin.shops.deleted');

Route::get('usuarios', Livewire\UserComponent::class) -> name('admin.users');
Route::get('perfil', Admin\ProfileController::class) -> name('admin.profile');

//ORDERS
Route::get('pedidos', Livewire\Order\Index::class) -> name('admin.orders');
Route::get('pedidos/tienda/{shop}', Livewire\Order\Shop::class) -> name('admin.orders.shop');
Route::get('pedidos/detalle/{order}', Livewire\Order\Show::class) -> name('admin.orders.show');

//SHIPPINGS
Route::get('envios', Livewire\Shipping\Index::class) -> name('admin.shippings');
Route::get('envios/tienda/{shop}', Livewire\Shipping\Shop::class) -> name('admin.shippings.shop');
Route::get('envios/detalle/{shipping}', Livewire\Shipping\Show::class) -> name('admin.shippings.show');
Route::get('envios/hoja-pedidos/{shipping}', [Admin\ShippingController::class, 'sheet']) -> name('admin.shippings.sheet');
Route::get('envios/hoja-control/{shipping}', [Admin\ShippingController::class, 'control']) -> name('admin.shippings.control');



Route::get('entradas', Livewire\Post\Index::class) -> name('admin.post.index');
Route::get('entradas/nueva', Livewire\Post\Create::class) -> name('admin.post.create');
Route::get('entradas/editar/{post}', Livewire\Post\Edit::class) -> name('admin.post.edit');


Route::get('categoriasBlog', Livewire\CategoryBlogComponent::class) -> name('admin.categoriesBlog');

Route::get('tagBlog', Livewire\TagBlogComponent::class) -> name('admin.tagsBlog');


