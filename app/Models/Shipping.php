<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Shipping extends Model
{
    use HasFactory;

    const PENDING = 1;
    const SENT_VOUCHER = 2;
    const PAYED = 3;
    const SENT = 4;

    protected $guarded = [];


    //RELATIONS
    public function shop()
    {
        return $this -> belongsTo(Shop::Class);
    }

    public function orders()
    {
        return $this -> hasMany(Order::Class);
    }

    public function tickets()
    {
        return $this -> hasMany(Ticket::Class);
    }

    public function responsable()
    {
        return $this -> belongsTo(User::Class, 'responsable_id', 'id');
    }


    //SCOPES
    public function scopeSearch($query, $search)
    {
        if ( trim( $search ) ) {
            return $query -> whereHas('shop', function(Builder $query) use( $search ) {
                return $query -> whereHas('user', function(Builder $query) use ( $search ) {
                    $query -> where('name', 'like', '%' . $search . '%');
                }) -> orWhere('shop_name', 'like', '%' . $search . '%');
            });
        }
    }

    public function scopeStatus($query, $status)
    {
        if ( trim( $status ) )
            return $query -> where('status', $status);
    }
}
