<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel;
use App\Http\Livewire\Panel as Livewire;

Route::get('dashboard', [Panel\DashboardController::class, 'dashboard']) -> name('panel.dashboard');
Route::get('pedidos', Livewire\Order\Index::class) -> name('panel.orders.index');
Route::get('pedidos/{order}', [Panel\OrderController::class, 'show']) -> name('panel.orders.show');
Route::get('envios', Livewire\Shipping\Index::class) -> name('panel.shippings.index');
Route::get('envios/crear', Livewire\Shipping\Create::class) -> name('panel.shippings.create');
Route::get('envios/detalle/{shipping}', Livewire\Shipping\Show::class) -> name('panel.shippings.show');
Route::get('clientes', Livewire\ClientIndex::class) -> name('panel.clients');
Route::get('banners', Panel\BannerController::class) -> name('panel.banners');
Route::get('mi-tienda', Livewire\MyBusiness::class) -> name('panel.my-business');
Route::get('perfil', Panel\ProfileController::class) -> name('panel.profile');
Route::post('suscribe', [Panel\DashboardController::class, 'suscribe']) -> name('panel.suscribe');