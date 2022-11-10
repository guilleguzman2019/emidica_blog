<?php

namespace App\Http\Livewire\Shop\Order;

use MercadoPago;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Mail\Shop\OrderCreated;
use App\Mail\Shop\OrderShopCreated;
use App\Models\Setting;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;

class Create extends Component
{
    public $shop, $token, $total, $shipping, $preferenceId;
    public $createArray = [
        'customer_name' => NULL,
        'customer_phone' => NULL,
        'customer_email' => NULL,
        'email_marketing' => NULL,
        'shipping_type' => NULL,
        'customer_address' => NULL,
        'customer_number' => NULL,
        'customer_neighborhood' => NULL,
        'customer_city' => NULL,
        'customer_province' => NULL,
        'customer_zip' => NULL,
        'customer_doc' => NULL,
        'payment_method' => NULL,
        'status' => 1,
        'shipping_cost' => NULL,
        'comments' => NULL
    ];

    protected $listeners = ['render'];

    public function mount()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $this -> token = substr(str_shuffle($permitted_chars), 0, 16);
        $this -> total = str_replace(',', '', Cart::subtotal());
    }

    public function updatedCreateArrayShippingType($value)
    {
        $settings = Setting::first();
        if ( $value == 1 ) {
            $this -> total = str_replace(',', '', Cart::subtotal());
            $this -> shipping = 'A coordinar';
            $this -> createArray['shipping_cost'] = 0;
        } elseif ( $value == 2 ) {
            $this -> total = (str_replace(',', '', Cart::subtotal())) + $settings -> shipping;
            $this -> shipping = '$ ' . number_format($settings -> shipping, 2, '.', ',');
            $this -> createArray['shipping_cost'] = $settings -> shipping;
        }
    }

    public function create()
    {
        $settings = Setting::first();

        $toValidate = [
            'createArray.customer_name' => 'required',
            'createArray.customer_phone' => 'required',
            'createArray.customer_email' => 'required|email',
            'createArray.shipping_type' => 'required',
            //'createArray.payment_method' => 'required',
        ];

        if ( $this -> createArray['shipping_type'] == 2 ) {
            $toValidate['createArray.customer_address'] = 'required';
            $toValidate['createArray.customer_city'] = 'required';
            $toValidate['createArray.customer_province'] = 'required';
            $toValidate['createArray.customer_zip'] = 'required';
            $toValidate['createArray.customer_doc'] = 'required';
        }

        $this -> validate( $toValidate );

        $this -> createArray['subtotal'] = str_replace(',', '', Cart::subtotal());
        $this -> createArray['total'] = str_replace(',', '', Cart::subtotal()) + $this -> createArray['shipping_cost'];
        $this -> createArray['token'] = $this -> token;
        $this -> createArray['shop_id'] = $this -> shop -> id;

        $order = Order::create( $this -> createArray );
        $items = json_decode(Cart::content());

        foreach($items as $item) :
            $variation = NULL;

            //agrego variacion
            if ( isset( $item -> options -> size_id ) ) {
                $variation = [ 'size' => $item -> options -> size_name ];
                $variation = json_encode($variation, JSON_FORCE_OBJECT);
            }
            if ( isset( $item -> options -> color_id ) ) {
                $variation = [ 'color' => $item -> options -> color_name ];
                $variation = json_encode($variation, JSON_FORCE_OBJECT);
            }

            //guardo producto en pedido
            OrderProduct::create([
                'product_name' => $item -> name,
                'sku' => $item -> options -> sku,
                'variation' => $variation,
                'quantity' => $item -> qty,
                'price_cost_usd' => $item -> options -> price_cost_usd,
                'price_cost_ars' => $item -> options -> price_cost_ars,
                'price_regular' => $item -> options -> price_regular,
                'price_sale' => $item -> options -> price_sale ?? 0,
                'total_cost_ars' => $item -> options -> price_cost_ars * $item -> qty,
                'total' => $item -> subtotal,
                'order_id' => $order -> id,
                'product_id' => $item -> id,
            ]);

            //resto stock
            $product = Product::find($item -> id);
            if ( isset( $item -> options -> size_id ) ) {
                $stock = $product -> sizes -> where('id', $item -> options -> size_id) -> first();
                $stock -> quantity = $stock -> quantity - $item -> qty;
                $stock -> save();
            } elseif ( isset( $item -> options -> color_id ) ) {
                $stock = $product -> colors -> where('id', $item -> options -> color_id) -> first();
                $stock -> quantity = $stock -> quantity - $item -> qty;
                $stock -> save();
            }

            $product -> quantity = $product -> quantity - $item -> qty;
            $product -> sales = $product -> sales + $item -> qty;
            $product -> save();

        endforeach;

        //LIMPIO CARRITO
        Cart::destroy();

        //ENVIO CORREOS
        Mail::to($order -> customer_email) -> send( new OrderCreated( $order ) );
        Mail::to($this -> shop -> user -> email) -> send( new OrderShopCreated( $order ) );

        return redirect() -> route('shop.order.show', [$this -> shop, $this -> token]);
    }

    public function render()
    {
        return view('livewire.shop.order.create');
    }
}
