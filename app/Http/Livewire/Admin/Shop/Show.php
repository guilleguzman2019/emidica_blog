<?php

namespace App\Http\Livewire\Admin\Shop;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Notifications\RejectVoucherNotification;
use App\Notifications\AcceptDomainNotification;
use App\Notifications\RejectDomainNotification;
use App\Notifications\ActiveAccountNotification;
use App\Notifications\ChangeStatusShopNotification;
use App\Models\Shop;
use App\Models\Order;

class Show extends Component
{
    public $customer, $status, $totalSales, $totalGain, $totalMonth, $totalGainMonth, $shop, $motive, $status_shop, $motive_status, $motive_domain, $start_date, $arrayShop = [], $arrayUser = [], $arraySuscriber = [];

    public function mount(Shop $shop)
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');

        $this -> shop = $shop;
        $this -> arrayShop = [
            'shop_name' => $shop -> shop_name,
            'slug' => $shop -> slug,
            'facebook' => $shop -> facebook,
            'instagram' => $shop -> instagram,
            'whatsapp' => $shop -> whatsapp,
            'domain' => $shop -> domain,
            'domain_status' => $shop -> domain_status,
        ];
        $this -> arrayUser = [
            'name' => $shop -> user -> name,
            'email' => $shop -> user -> email,
        ];
        $this -> arraySuscriber = [
            'plan' => $shop -> user -> suscriber -> plan,
            'payment_method' => $shop -> user -> suscriber -> payment_method,
            'preapproval_id' => $shop -> user -> suscriber -> preapproval_id,
            'start_date' => $shop -> user -> suscriber -> start_date ? $shop -> user -> suscriber -> start_date -> format('Y-m-d') : '',
            'renovation_date' => $shop -> user -> suscriber -> renovation_date ? $shop -> user -> suscriber -> renovation_date -> format('Y-m-d') : '',
            'address' => $shop -> user -> suscriber -> address,
            'city' => $shop -> user -> suscriber -> city,
            'province' => $shop -> user -> suscriber -> province,
            'phone' => $shop -> user -> suscriber -> phone,
        ];

        $this -> status_shop = $shop -> user -> suscriber -> status;
        $this -> start_date = date('Y-m-d');

        $this -> totalSales = Order::where('shop_id', $this -> shop -> id)
                                  -> whereIn('status', [5, 6, 7, 8, 9])
                                  -> get();

        $gain = [];
        foreach ($this -> totalSales as $rdr) {
            $gain[] = $rdr -> products -> sum('total_cost_ars');
        }
        $this -> totalGain = array_sum($gain);

        $this -> totalMonth = Order::where('shop_id', $this -> shop -> id)
                                  -> where('created_at', 'like', date('Y-m') . '%')
                                  -> whereIn('status', [5, 6, 7, 8, 9])
                                  -> get();

        $gainMonth = [];
        foreach ($this -> totalMonth as $rdr) {
            $gainMonth[] = $rdr -> products -> sum('total_cost_ars');
        }
        $this -> totalGainMonth = array_sum($gainMonth);
    }

    public function updatedArrayShopShopName( $value )
    {
        $this -> arrayShop['slug'] = Str::lower( Str::camel( $value ) );
    }

    public function update()
    {
        $this -> validate([
            'arrayShop.shop_name' => 'required',
            'arrayShop.slug' => 'required|unique:shops,slug,' . $this -> shop -> id,
            'arraySuscriber.plan' => 'required',
            'arraySuscriber.address' => 'required',
            'arraySuscriber.city' => 'required',
            'arraySuscriber.province' => 'required',
            'arrayUser.name' => 'required',
            'arrayUser.email' => 'required|unique:users,email,' . $this -> shop -> user -> id,
            'arraySuscriber.phone' => 'required',
        ]);

        if ( $this -> arraySuscriber['plan'] == 1 ) {
            $this -> arrayShop['domain_status'] = 2;
        }

        $this -> shop -> update( $this -> arrayShop );
        $this -> shop -> user -> update( $this -> arrayUser );
        $this -> shop -> user -> suscriber -> update( $this -> arraySuscriber );

        $this -> emit('updated');
    }

    public function active()
    {
        $this -> shop -> user -> suscriber -> start_date = $this -> start_date;
        $this -> shop -> user -> suscriber -> renovation_date = date('Y-m-d', strtotime($this -> start_date . "+ 1 month")); 
        $this -> shop -> user -> suscriber -> status = 3;
        $this -> shop -> user -> suscriber -> save();

        $this -> shop -> user -> notify( new ActiveAccountNotification($this -> shop -> user) );

        $this -> emit('updated');
    }

    public function rejectVoucher()
    {
        Storage::disk('public') -> delete($this -> shop -> user -> suscriber -> voucher);
        $this -> shop -> user -> suscriber -> voucher = NULL;
        $this -> shop -> user -> suscriber -> status = 1;
        $this -> shop -> user -> suscriber -> save();

        $this -> shop -> user -> notify( new RejectVoucherNotification($this -> shop -> user -> name, $this -> motive) );

        $this -> emit('deleted');
    }

    public function acceptDomain()
    {
        $this -> shop -> domain_status = 1;
        $this -> shop -> save();

        $this -> shop -> user -> notify( new AcceptDomainNotification($this -> shop -> user -> name) );

        $this -> emit('updated');
    }

    public function rejectDomain()
    {
        $this -> shop -> domain = NULL;
        $this -> shop -> domain_status = NULL;
        $this -> shop -> save();

        $this -> shop -> user -> notify( new RejectDomainNotification($this -> shop -> user -> name, $this -> motive_domain) );

        $this -> emit('updated');
    }

    public function changeStatus()
    {
        $toValidate = [ 'status_shop' => 'required' ];
        if ( $this -> status_shop == 4 || $this -> status_shop == 5 || $this -> status_shop == 6 ) {
            $toValidate['motive_status'] = 'required';
        }

        $this -> validate($toValidate);

        $this -> shop -> user -> suscriber -> status = $this -> status_shop;
        $this -> shop -> user -> suscriber -> save();

        $status = [4 => 'Tienda Cancelada', 5 => 'Tienda Suspendida', 6 => 'Tienda Eliminada'];

        if ( $this -> status_shop == 4 || $this -> status_shop == 5 || $this -> status_shop == 6 ) {
            $this -> shop -> user -> notify( new ChangeStatusShopNotification($status[$this -> status_shop], $this -> motive_status, $this -> shop -> user) );
        }

        $this -> reset('motive_status');
        $this -> emit('updated');

    }

    public function render()
    {
        $orders = Order::customer( $this -> customer )
                      -> status( $this -> status )
                      -> where('shop_id', $this -> shop -> id)
                      -> get();
        return view('livewire.admin.shop.show', compact('orders'));
    }
}
