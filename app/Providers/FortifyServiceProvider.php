<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Models\User;
use App\Models\Order;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email) -> where('state', 1) -> first();
     
            if ($user &&
                Hash::check($request->password, $user->password)) {

                $user -> last_login_at = date('Y-m-d H:i:s');
                $user -> save();


                //ELIMINO ÓRDENES CON MAS DE 10 DÍAS
                $fecha = date("Y-m-d",strtotime(date('Y-m-d') . "- 10 days"));
                $orders = Order::where('status', '<', 5) -> where('created_at', '<', $fecha) -> get();
                foreach ($orders as $order) {
                    $order -> status = 10;
                    $order -> save();

                    foreach ( $order -> products as $order_product ) {
                        if ( $order_product -> variation ) {

                            $variation = json_decode($order_product -> variation, true);

                            //COLOR
                            if ( isset( $variation['color'] ) )
                                $stock = $order_product -> product -> colors -> where('name', $variation['color']) -> first();

                            //TAMAÑO
                            if ( isset( $variation['size'] ) )
                                $stock = $order_product -> product -> sizes -> where('name', $variation['size']) -> first();

                            $stock -> quantity = $stock -> quantity + $order_product -> quantity;
                            $stock -> save();

                        }

                        $order_product -> product -> quantity = $order_product -> product -> quantity + $order_product -> quantity;
                        $order_product -> product -> save();
                    }

                    $order -> delete();
                }
                //fin ELIMINO ÓRDENES

                return $user;
            }

        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
