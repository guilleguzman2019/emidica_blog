<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;

class DashboarController extends Controller
{
    
    public function __invoke()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');

        //ordenes
            $orders = Order::whereBetween('created_at', [date('Y-m-') . '01', date('Y-m-d')]) -> where('status', '>', Order::REQUEST_SHIPPING) -> where('status', '<', Order::CANCELED) -> get();

        //sales by cateogry
            $categories = Category::where('parent_id', NULL) -> get();
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
                            $price[] = $op -> price_cost_ars;
                        }
                    }
                }

                $cats[$category -> id]['name'] = $category -> name;
                $cats[$category -> id]['sales'] = array_sum($price);
                $totals[] = array_sum($price);

            }

            $orderTotalMonth = array_sum($totals);


        //Daily sales
            $today = Order::where('created_at', 'like', date('Y-m-d').'%') -> where('status', '>', Order::REQUEST_SHIPPING) -> where('status', '<', Order::CANCELED) -> get();
            $array_today = [];
            foreach ($today as $tdy) {
                $array_today[] = $tdy -> products -> sum('price_cost_ars');
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
                    $sumCosts[] = $order -> products -> sum('price_cost_ars');
                }
                $array_totals[] = array_sum($sumCosts);
            }

        //shops count
            $shops = User::whereBetween('created_at', [date('Y-m-') . '01', date('Y-m-d')]) -> where('user_type', '4') -> where('state', '1') -> get();


        //ventas mensuales
            $month = ['', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
            $monthArray = [];
            for ($i = 11; $i >= 1; $i--) {
                $d = date('Y-m-01', strtotime(date('Y-m-01')."-{$i} month"));
                array_push($monthArray, $d);
            }
            $monthArray[] = date('Y-m-01');
            $saleMonth = [];
            $month_year = [];
            foreach ($monthArray as $ma) {
                $order = Order::where('created_at', 'like', substr($ma, 0, -3) . "%") -> where('status', '>', Order::REQUEST_SHIPPING) -> where('status', '<', Order::CANCELED) -> get();
                $sum = [];
                foreach ($order as $rdr) {
                    $sum[] = $rdr -> products -> sum('price_cost_ars');
                }
                $saleMonth[$ma] = array_sum($sum);
                $month_year[] = $month[date('n', strtotime($ma))] . ' ' . date('y', strtotime($ma));
            }


        return view('admin.dashboard', compact('orderTotalMonth', 'array_today', 'shops', 'cats', 'array_days', 'array_totals', 'orders', 'saleMonth', 'month_year'));
    }

}
