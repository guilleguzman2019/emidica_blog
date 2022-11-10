<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    const ADMIN = 1;
    const COMERCIAL = 2;
    const FINANCE = 3;
    const SUSCRIBER = 4;
    const GESTOR = 5;
    const REQUESTS = 6;
    const SHIPPINGS = 7;
    const MARKETING = 8;

    protected $fillable = [
        'name',
        'email',
        'password',
        'state',
        'user_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected $dates = [
        'last_login_at'
    ];

    //RELATIONS
    public function suscriber()
    {
        return $this -> hasOne(Suscriber::Class);
    }

    public function shop()
    {
        return $this -> hasOne(Shop::Class);
    }

    public function bannersShop()
    {
        return $this -> hasMany(BannerShop::class);
    }


    //SCOPES
    public function scopeSearch($query, $search)
    {
        if ( trim( $search ) )
            return $query -> WhereHas('shop', function(Builder $query) use ($search) {
                $query -> where('shop_name', 'like',  '%' . $search . '%');
            }) -> orWHere('name', 'like',  '%' . $search . '%');
    }
}
