<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago;

class WebhookController extends Controller
{
    public function __invoke(Request $request)
    {

        MercadoPago\SDK::setAccessToken( config('services.mercadopago.token') );

        switch($_POST["type"]) {
          case "subscription":
              $plan = MercadoPago\Subscription::find_by_id($_POST["data"]["id"]);
              break;
        }
        

        //\Log::info($request -> all());
    }
}
