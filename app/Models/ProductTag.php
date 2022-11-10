<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;

    protected $guarded = [];


    //RELATIONS
    public function products()
    {
        return $this -> belongsTo(Product::Class);
    }

    public function tags()
    {
        return $this -> belongsTo(Tag::Class);
    }
}
