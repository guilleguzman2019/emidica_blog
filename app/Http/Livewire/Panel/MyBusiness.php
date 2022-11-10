<?php

namespace App\Http\Livewire\Panel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;

class MyBusiness extends Component
{
    use WithFileUploads;

    public $shop, $suscriber, $logo, $logo_foot, $categories, $categoriesShop, $categoriesShopSelected = true;

    public function mount()
    {
        $this -> categories = Category::where('parent_id', NULL) -> orderBy('name') -> get();
        $this -> shop = [
            'shop_name' => Auth::user() -> shop -> shop_name,
            'description' => Auth::user() -> shop -> description,
            'logo' => Auth::user() -> shop -> logo,
            'logo_foot' => Auth::user() -> shop -> logo_foot,
            'cash' => Auth::user() -> shop -> cash,
            'bank' => Auth::user() -> shop -> bank,
            'mpago' => Auth::user() -> shop -> mpago,
            'bank_name' => Auth::user() -> shop -> bank_name,
            'bank_titular' => Auth::user() -> shop -> bank_titular,
            'bank_cuit' => Auth::user() -> shop -> bank_cuit,
            'bank_cbu' => Auth::user() -> shop -> bank_cbu,
            'bank_alias' => Auth::user() -> shop -> bank_alias,
            'mp_public_key' => Auth::user() -> shop -> mp_public_key,
            'mp_access_token' => Auth::user() -> shop -> mp_access_token,
            'delivery_home' => Auth::user() -> shop -> delivery_home,
            'delivery_coordinate' => Auth::user() -> shop -> delivery_coordinate,
            'facebook' => Auth::user() -> shop -> facebook,
            'instagram' => Auth::user() -> shop -> instagram,
            'whatsapp' => Auth::user() -> shop -> whatsapp,
            'shop_mail' => Auth::user() -> shop -> shop_mail,
            'categories' => Auth::user() -> shop -> categories,
            'meta_title' => Auth::user() -> shop -> meta_title,
            'meta_description' => Auth::user() -> shop -> meta_description,
            'meta_keywords' => Auth::user() -> shop -> meta_keywords,
            'google_analytics' => Auth::user() -> shop -> google_analytics,
            'facebook_pixel' => Auth::user() -> shop -> facebook_pixel,
        ];

        $arrayCats = [];
        foreach ($this -> categories as $cat) {
            $arrayCats[] = $cat -> id;
        }

        $categoriesShop = json_decode(Auth::user() -> shop -> categories);
        foreach ($categoriesShop as $catShop) {
            if ( Category::where('id', $catShop) -> where('parent_id', NULL) -> first()  )
                $this -> categoriesShop[$catShop] = $catShop;
        }

        $this -> suscriber = [
            'phone'  => Auth::user() -> suscriber -> phone,
            'address'  => Auth::user() -> suscriber -> address,
            'city'  => Auth::user() -> suscriber -> city,
            'province'  => Auth::user() -> suscriber -> province,
        ];
    }

    public function update()
    {
        $descendantsIds = [];
        foreach ($this -> categoriesShop as $categoriesShop) {
            if ( $categoriesShop ) {
                //$array[] = $categoriesShop;

                $categoriaTop = Category::where('id', $categoriesShop) -> first();
                //dd($categoriaTop -> descendants);

                $descendantsIds = $categoriaTop -> descendants -> pipe(function ( $collection ) use ($categoriesShop) {
                    $array = $collection -> toArray();
                    $ids[] = $categoriesShop;
                    array_walk_recursive( $array, function ($value, $key) use (& $ids) {
                        if ( $key === 'id' ) {
                            $ids[] = $value;
                        };
                    });
                    return $ids;
                });

                //dd($descendantsIds);

                /*foreach ($categoriaTop -> descendants as $sc) {
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
                }*/
            } else {

            }
        }

        //dd(count($descendantsIds));

        if ( ! count($descendantsIds) ) {
            $this -> categoriesShopSelected = NULL;
        } else {
            $this -> categoriesShopSelected = true;
            $catsSelected = json_encode($descendantsIds, JSON_FORCE_OBJECT);
            $this -> shop['categories'] = $catsSelected;
        }

        $toValidate = [
            'shop.shop_name' => 'required|unique:shops,shop_name,' . Auth::user() -> shop -> id,
            'shop.shop_mail' => 'required|email:rfc,dns',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'logo_foot' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'categoriesShopSelected' => 'required'
        ];

        if ( $this -> shop['bank'] ) {
            $toValidate['shop.bank_name'] = 'required';
            $toValidate['shop.bank_titular'] = 'required';
            $toValidate['shop.bank_cuit'] = 'required';
            $toValidate['shop.bank_cbu'] = 'required';
            $toValidate['shop.bank_alias'] = 'required';
        }

        if ( $this -> shop['mpago'] ) {
            $toValidate['shop.mp_public_key'] = 'required';
            $toValidate['shop.mp_access_token'] = 'required';
        }

        $this -> validate( $toValidate );


        if ( $this -> logo ) {
            Storage::disk('public') -> delete(Auth::user() -> shop -> logo);
            $this -> shop['logo'] = $this -> logo -> store('img/logos');
        }

        if ( $this -> logo_foot ) {
            Storage::disk('public') -> delete(Auth::user() -> shop -> logo_foot);
            $this -> shop['logo_foot'] = $this -> logo_foot -> store('img/logos');
        }

        Auth::user() -> shop -> update( $this -> shop );

        $this -> emit('updated');
    }

    public function render()
    {
        return view('livewire.panel.my-business');
    }
}
