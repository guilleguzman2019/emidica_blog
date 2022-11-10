<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagBlog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function posts()
    {
        return $this -> hasMany(Post::Class);
    }

    public function tags()
    {
        return $this -> hasMany(PostTag::Class);
    }


    //URL friendly
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
