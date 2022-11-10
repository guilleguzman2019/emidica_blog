<?php

namespace App\Http\Livewire\Panel;

use MercadoPago;
use Notification;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewNotification;
use App\Notifications\NewPaymentSuscriberNotification;
use App\Models\Category;
use App\Models\Banner;
use App\Models\User;

class CompleteInfoShop extends Component
{
    use WithFileUploads;

    public $plan, $voucher, $logo, $logo_foot, $facebook, $instagram, $whatsapp, $shop_mail, $categories, $cash, $bank, $mpago, $delivery_home, $delivery_coordinate, $delivery_selected, $categoriesShop, $method_selected, $bank_name, $bank_titular, $bank_cuit, $bank_cbu, $bank_alias, $mp_public_key, $mp_access_token, $logo_actual, $logo_foot_actual;
    public $step = 1;
    public $firstInfo = false;
    public $sencondInfo = false;

    public function mount()
    {
        $this -> categories = Category::where('parent_id', NULL) -> orderBy('name') -> get();
        $this -> plan = Auth::user() -> suscriber -> plan;
        $this -> facebook = Auth::user() -> shop -> facebook;
        $this -> instagram = Auth::user() -> shop -> instagram;
        $this -> whatsapp = Auth::user() -> shop -> whatsapp;
        $this -> shop_mail = Auth::user() -> shop -> shop_mail;
        $this -> cash = Auth::user() -> shop -> cash;
        $this -> bank = Auth::user() -> shop -> bank;
        $this -> mpago = Auth::user() -> shop -> mpago;
        $this -> delivery_home = Auth::user() -> shop -> delivery_home;
        $this -> delivery_coordinate = Auth::user() -> shop -> delivery_coordinate;
        $this -> bank_name = Auth::user() -> shop -> bank_name;
        $this -> bank_titular = Auth::user() -> shop -> bank_titular;
        $this -> bank_cuit = Auth::user() -> shop -> bank_cuit;
        $this -> bank_cbu = Auth::user() -> shop -> bank_cbu;
        $this -> bank_alias = Auth::user() -> shop -> bank_alias;
        $this -> mp_public_key = Auth::user() -> shop -> mp_public_key;
        $this -> mp_access_token = Auth::user() -> shop -> mp_access_token;
        $this -> logo_actual = Auth::user() -> shop -> logo;
        $this -> logo_foot_actual = Auth::user() -> shop -> logo_foot;
        if ( Auth::user() -> suscriber -> categories ) {
            $categoriesShop = json_decode(Auth::user() -> suscriber -> categories);
            foreach ($categoriesShop as $catShop) {
                if ( $catShop )
                    $this -> categoriesShop[$catShop] = $catShop;
            }
        }

        if ( Auth::user() -> suscriber -> voucher ) {
            $this -> step = 2;
        } 

        if ( Auth::user() -> shop -> logo && Auth::user() -> shop -> logo_foot && Auth::user() -> shop -> facebook && Auth::user() -> shop -> instagram && Auth::user() -> shop -> whatsapp && Auth::user() -> shop -> shop_mail ) {
            $this -> firstInfo = true;
        } elseif ( Auth::user() -> shop -> cash && Auth::user() -> shop -> categories ) {
            $this -> secondInfo = true;
            $this -> step = 3;
        }
    }

    public function updatedVoucher()
    {
        $this -> validate([
            'voucher' => 'file|mimes:png,jpg,jpeg,pdf|max:4096'
        ]);
    }

    public function saveStep1()
    {
        $this -> validate([
            'voucher' => 'required',
            'plan' => 'required'
        ]);

        $voucher = $this -> voucher -> store('vouchers');

        Auth::user() -> suscriber -> update([
            'voucher' => $voucher,
            'plan' => $this -> plan,
            'status' => 2
        ]);

        //ENVÍO NOTIFICACIÓN A ADMIN
        $schema = User::where('user_type', User::ADMIN) -> get();
        $schema2 = User::where('user_type', User::FINANCE) -> get();
        $notification = [
            'title' => 'Pago de nueva suscripción',
            'content' => 'Hay un nuevo suscriptor que realizó su primer pago y envió el voucher.',
            'url' => route('admin.shops.show', Auth::user() -> shop)
        ];

        Notification::send($schema, new NewNotification($notification));
        Notification::send($schema2, new NewNotification($notification));

        foreach ($schema2 as $user) {
            $user -> notify( new NewPaymentSuscriberNotification(Auth::user() -> name, Auth::user() -> shop -> shop_name, Auth::user() -> shop -> slug) );
        }
        foreach ($schema as $user) {
            $user -> notify( new NewPaymentSuscriberNotification(Auth::user() -> name, Auth::user() -> shop -> shop_name, Auth::user() -> shop -> slug) );
        }

        $this -> step = 2;

        $this -> emit('uploaded');
    }

    public function saveFirst()
    {
        $this -> validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'logo_foot' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'shop_mail' => 'required|email:rfc,dns'
        ]);

        if ( $this -> logo ) {
            Auth::user() -> shop -> logo = $this -> logo -> store('img/logos');
        }

        if ( $this -> logo_foot ) {
            Auth::user() -> shop -> logo_foot = $this -> logo_foot -> store('img/logos');
        }

        Auth::user() -> shop -> facebook = $this -> facebook;
        Auth::user() -> shop -> instagram = $this -> instagram;
        Auth::user() -> shop -> whatsapp = $this -> whatsapp;
        Auth::user() -> shop -> shop_mail = $this -> shop_mail;
        Auth::user() -> shop -> save();

        $this -> firstInfo = true;

        $this -> emit('updated');
    }

    public function saveSecond()
    {
        $array = array();
        if ( $this -> categoriesShop ) {
            foreach ($this -> categoriesShop as $categoriesShop) {
                if ( $categoriesShop ) {
                    $array[] = $categoriesShop;

                    $categoriaTop = Category::where('id', $categoriesShop) -> first();
                    foreach ($categoriaTop -> descendants as $sc) {
                        $array[] = $sc -> id;

                        foreach ($sc -> descendants as $sc2) {
                            $array[] = $sc2 -> id;

                            foreach ($sc2 -> descendants as $sc3) {
                                $array[] = $sc3 -> id;

                                foreach ($sc3 -> descendants as $sc4) {
                                    $array[] = $sc4 -> id;

                                    foreach ($sc4 -> descendants as $sc5) {
                                        $array[] = $sc5 -> id;

                                        foreach ($sc5 -> descendants as $sc6) {
                                            $array[] = $sc6 -> id;

                                            foreach ($sc6 -> descendants as $sc7) {
                                                $array[] = $sc7 -> id;

                                                foreach ($sc7 -> descendants as $sc8) {
                                                    $array[] = $sc8 -> id;

                                                    foreach ($sc8 -> descendants as $sc9) {
                                                        $array[] = $sc9 -> id;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                    //adjunto los banners de las categorías seleccionadas
                    $arrayBanners = array();
                    $banners = Banner::where('status', 1) -> where('location', 1) -> where('category_id', $categoriesShop) -> get();
                    foreach ($banners as $banner) {
                        $arrayBanners[] = $banner -> id;
                    }
                    $jsonBanners = json_encode($arrayBanners, JSON_FORCE_OBJECT);
                }
            }
        }

        if ( !count($array) ) { $this -> categoriesShop = NULL; }
        $toValidate['categoriesShop'] = 'required';

        if ( ! $this -> cash && ! $this -> bank && ! $this -> mpago ){ $this -> method_selected = NULL; } else { $this -> method_selected = '1'; }
        $toValidate['method_selected'] = 'required';

        if ( ! $this -> delivery_home && ! $this -> delivery_coordinate ){ $this -> delivery_selected = NULL; } else { $this -> delivery_selected = '1'; }
        $toValidate['delivery_selected'] = 'required';


        if ( $this -> bank ) {
            $toValidate['bank_name'] = 'required';
            $toValidate['bank_titular'] = 'required';
            $toValidate['bank_cuit'] = 'required';
            $toValidate['bank_cbu'] = 'required';
            $toValidate['bank_alias'] = 'required';
        }

        if ( $this -> mpago ) {
            $toValidate['mp_public_key'] = 'required';
            $toValidate['mp_access_token'] = 'required';
        }

        $this -> validate( $toValidate );

        $catsSelected = json_encode($array, JSON_FORCE_OBJECT);

        Auth::user() -> shop -> categories = $catsSelected;
        Auth::user() -> shop -> banners = $jsonBanners;
        Auth::user() -> shop -> cash = $this -> cash;
        Auth::user() -> shop -> bank = $this -> bank;
        Auth::user() -> shop -> mpago = $this -> mpago;
        Auth::user() -> shop -> delivery_home = $this -> delivery_home;
        Auth::user() -> shop -> delivery_coordinate = $this -> delivery_coordinate;
        Auth::user() -> shop -> bank_name = $this -> bank_name;
        Auth::user() -> shop -> bank_titular = $this -> bank_titular;
        Auth::user() -> shop -> bank_cuit = $this -> bank_cuit;
        Auth::user() -> shop -> bank_cbu = $this -> bank_cbu;
        Auth::user() -> shop -> bank_alias = $this -> bank_alias;
        Auth::user() -> shop -> mp_public_key = $this -> mp_public_key;
        Auth::user() -> shop -> mp_access_token = $this -> mp_access_token;
        Auth::user() -> shop -> save();


        $this -> secondInfo = true;
        $this -> step = 3;

        $this -> emit('updated');

    }

    public function render()
    {
        return view('livewire.panel.complete-info-shop');
    }
}
