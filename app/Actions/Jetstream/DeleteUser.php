<?php

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;
use App\Notifications\DeletedAccountNotification;
use App\Models\User;
use MercadoPago;

class DeleteUser implements DeletesUsers
{

    public function delete($user)
    {
        if ( $user -> suscriber ) {

            MercadoPago\SDK::setAccessToken( config('services.mercadopago.token') );
            $suscription = MercadoPago\Subscription::find_by_id($user -> suscriber -> preapproval_id);
            dd($suscription);


            $user -> suscriber -> status = 6;
            $user -> suscriber -> save();

            $finances = User::where('user_type', 3) -> get();
            foreach ($finances as $finance) {
                $finance -> notify( new DeletedAccountNotification($user, $finance) );
            }

        }

        $user -> deleteProfilePhoto();
        $user -> tokens -> each -> delete();
        $user -> delete();
    }
}
