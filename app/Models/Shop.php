<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Shop extends Model
{
    use HasFactory;
    protected $guarded = [];

    //RELATIONS
    public function user()
    {
        return $this -> belongsTo(User::Class);
    }

    public function orders()
    {
        return $this -> hasMany(Order::Class);
    }

    public function shippings()
    {
        return $this -> hasMany(Shipping::Class);
    }


    //SCOPES
    public function scopeSearch($query, $search)
    {
        if ( trim( $search ) )
            return $query -> WhereHas('user', function(Builder $query) use ($search) {
                $query -> where('name', 'like',  '%' . $search . '%');
            }) -> orWHere('shop_name', 'like',  '%' . $search . '%');
    }

    public function scopeStatus($query, $status)
    {
        if ( trim( $status ) )
            return $query -> whereHas('user', function(Builder $query) use ($status) {
                $query -> whereHas('suscriber', function(Builder $query) use ($status) {
                    $query -> where('status', $status);
                });
            });
    }

    public function scopeStatusOrder($query, $status)
    {
        if ( trim( $status ) )
            return $query -> whereHas('orders', function(Builder $query) use ($status) {
                $query -> where('status', $status);
            });
    }


    //URL friendly
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
