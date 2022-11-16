<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User'); // user_id
    }
    public function category()
    {
        return $this->belongsTo('App\Models\CategoryPost'); // category_id
    }
    public function postTags()
    {
        return $this -> hasMany(PostTag::Class);
    }

    public function scopeSearch($query, $search)
    {
        if ( trim( $search ) )
            return $query -> where(\DB::raw("CONCAT(title, ' ', body)"), 'LIKE', '%' . $search . '%');
    }

    //URL friendly
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
