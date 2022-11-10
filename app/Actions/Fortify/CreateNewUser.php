<?php

namespace App\Actions\Fortify;

use Notification;
use App\Models\User;
use App\Models\Suscriber;
use App\Models\Shop;
use App\Notifications\NewNotification;
use App\Notifications\NewSuscriberNotification;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input)
    {
        $input['slug'] = Str::lower( Str::camel( $input['shop_name'] ) );

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'birthdate' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'shop_name' => ['required', 'string', 'max:255', 'unique:shops'],
            'slug' => ['unique:shops'],
            'phone' => ['required'],
            'doc_number' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'province' => ['required'],
            'zip' => ['required'],
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'user_type' => 4,
            'state' => 1,
            'last_login_at' => date('Y-m-d H:i:s'),
        ]);

        Suscriber::create([
            'doc_number' => $input['doc_number'],
            'birthdate' => $input['birthdate'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'city' => $input['city'],
            'province' => $input['province'],
            'zip' => $input['zip'],
            'status' => 1,
            'user_id' => $user -> id
        ]);

        Shop::create([
            'shop_name' => $input['shop_name'],
            'slug' => $input['slug'],
            'user_id' => $user -> id
        ]);

        //ENVÍO NOTIFICACIÓN A ADMIN
        $schema = User::where('user_type', User::ADMIN) -> get();
        $schema2 = User::where('user_type', User::COMERCIAL) -> get();
        $notification = [
            'title' => 'Nueva suscripción',
            'content' => 'Hay un nuevo suscriptor.',
            'url' => route('admin.shops.show', $user -> shop -> shop_name)
        ];

        Notification::send($schema, new NewNotification($notification));
        Notification::send($schema2, new NewNotification($notification));

        foreach ($schema as $admin) { $admin -> notify( new NewSuscriberNotification( $user -> name, $user -> email ) ); }
        foreach ($schema2 as $comercial) { $comercial -> notify( new NewSuscriberNotification( $user -> name, $user -> email ) ); }

        $user -> notify( new WelcomeNotification( $user -> name ) );

        return $user;
    }
}
