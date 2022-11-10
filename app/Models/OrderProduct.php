<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    //RELATIONS
    public function order()
    {
        return $this -> belongsTo(Order::Class);
    }

    public function product()
    {
        return $this -> belongsTo(Product::Class);
    }
}
