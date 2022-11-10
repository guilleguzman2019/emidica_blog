<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    //RELATIONS
    public function productTags()
    {
        return $this -> hasMany(ProductTag::Class);
    }


    //URL friendly
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
