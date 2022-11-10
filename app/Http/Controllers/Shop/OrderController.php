<?php

namespace App\Http\Controllers\Shop;

use MercadoPago;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Setting;

class OrderController extends Controller
{

    public function create(Shop $shop)
    {
        if ( ! $shop -> user ) { abort(404); }

        $settings = Setting::first();
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = substr(str_shuffle($permitted_chars), 0, 16);
        $total = str_replace(',', '', Cart::subtotal());

        return view('shop.order.create', compact('shop', 'token', 'total', 'settings'));
    }

    public function show(Shop $shop, $token)
    {
        if ( ! $shop -> user ) { abort(404); }

        $order = Order::where('token', $token) -> firstOrFail();
        $preference_id = NULL;

        if ( $shop -> user -> suscriber -> plan == 2 && $shop -> mpago ) {
            MercadoPago\SDK::setAccessToken( $shop -> mp_access_token );
            $preference = new MercadoPago\Preference();

            $item = new MercadoPago\Item();
            $item -> title = $shop -> shop_name;
            $item -> quantity = 1;
            $item -> unit_price = (float)$order -> total;

            $preference -> items = array( $item );
            $preference -> back_urls = array(
                'success' => route('checkPayment', [$shop, $token, base64_encode(Hash::make('success'))]),
                'pending' => route('checkPayment', [$shop, $token, base64_encode(Hash::make('pending'))]),
                'failure' => route('checkPayment', [$shop, $token, base64_encode(Hash::make('failure'))]),
            );

            $preference -> external_reference = $token;
            $preference -> notification_url = url('/' . $shop -> slug . '/ipn/mercadopago');
            $preference -> save();
            $preference_id = $preference -> id;
        }

        return view('shop.order.show', compact('shop', 'order', 'preference_id'));
    }

    public function checkPayment(Shop $shop, $token, $status)
    {
        if ( ! $shop -> user ) { abort(404); }

        $status = base64_decode($status);

        $order = Order::where('token', $token) -> firstOrFail();
        $order -> payment_method = 3;

        if ( Hash::check('success', $status) ) {
            $order -> status = Order::PAYED;
        } elseif ( Hash::check('pending', $status) ) {
            $order -> status = Order::ON_PROCESS;
        } elseif ( Hash::check('failure', $status) ) {
            $order -> status = Order::REJECT;
        }

        $order -> save();

        return redirect() -> route('shop.order.show', [$shop, $token]);

    }

}
