<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];


    //RELATIONS
    public function subcategories()
    {
        return $this -> hasMany(Category::Class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this -> belongsTo(Category::Class, 'parent_id');
    }

    public function children()
    {
        return $this -> hasMany(Category::Class, 'parent_id');
    }

    public function descendants()
    {
       return $this -> children() -> with('descendants');
    }

    public function products()
    {
        return $this -> hasMany(Product::Class);
    }

    public function banners()
    {
        return $this -> hasMany(Banner::Class);
    }

    public function getAscendantsAttribute()
    {
        $parents = collect([]);
        $parent = $this -> parent;
        while ( ! is_null( $parent ) ) {
            $parents -> push( $parent );
            $parent = $parent -> parent;
        }
        return $parents;
    }

    //URL friendly
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
