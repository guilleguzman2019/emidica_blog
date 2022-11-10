<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    use HasFactory;

    const PENDING = 1;
    const PAYED = 2;
    const ON_PROCESS = 3;
    const REJECT = 4;
    const REQUEST_SHIPPING = 5;
    const REQUEST_SHIPPING_APPROVE = 6;
    const IN_PREPARATION = 7;
    const READY_TO_SHIPPING = 8;
    const DISPATCHED = 9;
    const CANCELED = 10;

    protected $guarded = [];

    //RELATIONS
    public function shop()
    {
        return $this -> belongsTo(Shop::Class);
    }
    public function products()
    {
        return $this -> hasMany(OrderProduct::Class);
    }


    //SCOPES
    public function scopeCustomer($query, $customer)
    {
        if ( trim( $customer ) )
            return $query -> where('customer_name', 'like', '%' . $customer . '%');
    }

    public function scopeStatus($query, $status)
    {
        if ( trim( $status ) )
            return $query -> where('status', $status);
    }
}
