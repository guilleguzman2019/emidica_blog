<?php

namespace App\Http\Controllers\Panel;

use MercadoPago;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Category;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if ( ! Auth::user() -> suscriber -> voucher || ! Auth::user() -> suscriber -> status || ! Auth::user() -> shop -> categories || ( ! Auth::user() -> shop -> cash && ! Auth::user() -> shop -> bank && ! Auth::user() -> shop -> mpago ) ) :

            return view('panel.welcome');

        else :

            //ORDERS without shipping
             $ordersws = Order::where('shop_id', Auth::user() -> shop -> id)
                             -> where('status', 2)
                             -> get();

            //ordenes
                $orders = Order::where('shop_id', Auth::user() -> shop -> id)
                              -> whereBetween('created_at', [date('Y-m-') . '01', date('Y-m-d')])
                              -> whereIn('status', [2, 5, 6, 7, 8, 9])
                              -> get();

            //sales by cateogry
                $categoriesShop = json_decode(Auth::user() -> shop -> categories, true);
                $categories = Category::whereIn('id', $categoriesShop) -> where('parent_id', NULL) -> orderBy('name') -> get();
                $cats = [];
                $totals = [];

                foreach ($categories as $category) {
                    $cats[$category -> id]['name'] = $category -> name;

                    $descendantsIds = $category -> descendants -> pipe(function ( $collection ) use ($category) {
                        $array = $collection -> toArray();
                        $ids[] = $category -> id;
                        array_walk_recursive( $array, function ($value, $key) use (& $ids) {
                            if ( $key === 'id' ) {
                                $ids[] = $value;
                            };
                        });
                        return $ids;
                    });

                    $price = [];
                    foreach ($orders as $order) {
                        foreach ($order -> products as $op) {
                            if ( in_array($op -> product -> category_id, $descendantsIds) ) {
                                $price[] = $op -> total;
                            }
                        }
                    }

                    $cats[$category -> id]['name'] = $category -> name;
                    $cats[$category -> id]['sales'] = array_sum($price);
                    $totals[] = array_sum($price);

                }

                $orderTotalMonth = array_sum($totals);

            //Daily sales
                $today = Order::where('shop_id', Auth::user() -> shop -> id) -> where('created_at', 'like', date('Y-m-d').'%') -> whereIn('status', [2, 5, 6, 7, 8, 9]) -> get();
                $array_today = [];
                foreach ($today as $tdy) {
                    $array_today[] = $tdy -> products -> sum('total');
                }
                $array_today = array_sum($array_today);

                $days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                $array_days = [];
                $array_totals = [];
                $dateArr = [];
                for ($i = 6; $i >= 0; $i--) {
                    array_push($dateArr, date('Y-m-d', strtotime("-{$i} day")));
                }

                $test = [];
                foreach ($dateArr as $da) {
                    $array_days[] = $days[date('w', strtotime($da))];

                    $ordersDaily = Order::where('created_at', 'like', "$da%") -> where('status', '>', Order::REQUEST_SHIPPING) -> where('status', '<', Order::CANCELED) -> get();
                    $test[] = $ordersDaily;
                    $sumCosts = [];
                    foreach ($ordersDaily as $order) {
                        $sumCosts[] = $order -> products -> sum('total');
                    }
                    $array_totals[] = array_sum($sumCosts);
                }

            //Customers
                $customers = Order::where('shop_id', Auth::user() -> shop -> id)
                                -> groupBy('customer_email')
                                -> get();

            //ventas mensuales
                $month = ['', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                $monthArray = [];
                for ($i = 11; $i >= 1; $i--) {
                    $d = date('Y-m-01', strtotime(date('Y-m-01')."-{$i} month"));
                    array_push($monthArray, $d);
                }
                $monthArray[] = date('Y-m-01');
                $saleMonth = [];
                $gainMonth = [];
                $month_year = [];
                foreach ($monthArray as $ma) {
                    $orderMonthly = Order::where('created_at', 'like', substr($ma, 0, -3) . "%")
                                 -> where('shop_id', Auth::user() -> shop -> id)
                                 -> whereIn('status', [2, 5, 6, 7, 8, 9])
                                 -> get();

                    $sum = [];
                    $gain = [];

                    foreach ($orderMonthly as $rdr) {
                        $sum[] = $rdr -> products -> sum('total');
                        $gain[] = $rdr -> products -> sum('total') - $rdr -> products -> sum('total_cost_ars');
                    }
                    $saleMonth[$ma] = array_sum($sum);
                    $gainMonth[$ma] = array_sum($gain);
                    $month_year[] = $month[date('n', strtotime($ma))] . ' ' . date('y', strtotime($ma));
                }

            return view('panel.dashboard', compact('ordersws', 'orders', 'orderTotalMonth', 'cats', 'array_today', 'array_totals', 'array_days', 'customers', 'saleMonth', 'gainMonth', 'month_year'));
        endif;
    }

    public function suscribe(Request $request)
    {

        /*
        array:7 [
            "token" => "e34ef927fe83afd78c1847856b00e616"
            "issuer_id" => "310"
            "payment_method_id" => "visa"
            "transaction_amount" => 3900
            "installments" => 1
            "description" => "Descripción del producto"
            "payer" => array:2 [
                "email" => "test_user_14414861@testuser.com"
                "identification" => array:2 [
                    "type" => "DNI"
                    "number" => "12345678"
                ]
            ]
            "user_id" => 63
        ]
        */

        MercadoPago\SDK::setAccessToken( config('services.mercadopago.token') );
        $preapproval_data = new MercadoPago\Preapproval();

        $preapproval_data -> preapproval_plan_id = '2c93808482d01a5a0182db58759c0475';
        $preapproval_data -> reason = "Subscripción mensual Emidica Premium";
        $preapproval_data -> external_reference = 'user-' . $request['user_id'];
        $preapproval_data -> payer_email = $request -> payer['email'];
        $preapproval_data -> card_token_id = $request['token'];
        $preapproval_data -> auto_recurring = array( 
            "frequency" => 1,
            "frequency_type" => "months",
            "start_date" => date(DATE_ISO8601),
            "end_date" => date(DATE_ISO8601, strtotime('+5 years')),
            "transaction_amount" => 5,
            "currency_id" => "ARS", // your currency
        );
        $preapproval_data -> back_url = route('panel.dashboard');
        $preapproval_data -> status = 'authorized';
        $preapproval_data -> save();

        dd($preapproval_data);
    }
}
