<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    const BORRADOR = 1;
    const PUBLICADO = 2;


    public function getStockAttribute()
    {

        if ( $this -> variation == 3 ) {

            return $this -> sizes -> sum('quantity');

        } elseif ( $this -> variation == 2 ) {

            return $this -> colors -> sum('quantity');

        } else {

            return $this -> quantity;

        }

    }

    //RELATIONS
    public function category()
    {
        return $this -> belongsTo(Category::Class);
    }

    public function brand()
    {
        return $this -> belongsTo(Brand::Class);
    }

    public function images()
    {
        return $this -> morphMany(Image::Class, 'imageable');
    }

    public function colors()
    {
        return $this -> hasMany(ProductColor::Class);
    }

    public function sizes()
    {
        return $this -> hasMany(ProductSize::Class);
    }

    public function productTags()
    {
        return $this -> hasMany(ProductTag::Class);
    }


    //SCOPES
    public function scopeSearch($query, $search)
    {
        if ( trim( $search ) )
            return $query -> where(\DB::raw("CONCAT(name, ' ', sku)"), 'LIKE', '%' . $search . '%');
    }

    public function scopeCategoryId($query, $category_id)
    {
        if ( trim( $category_id ) ) {
            $category = Category::where('id', $category_id) -> first();
            $cats[] = $category -> id;
            foreach ($category -> children as $cat) {
                $cats[] = $cat -> id;
                foreach ($cat -> children as $cat1) {
                    $cats[] = $cat1 -> id;
                    foreach ($cat1 -> children as $cat2) {
                        $cats[] = $cat2 -> id;
                        foreach ($cat2 -> children as $cat3) {
                            $cats[] = $cat3 -> id;
                        }
                    }
                }
            }

            return $query -> whereIn('category_id', $cats);
        }
    }

    public function scopeOrderList($query, $order_list)
    {
        if ( trim( $order_list ) )
            return $query -> orderBy($order_list);
    }

    public function scopeOrder($query, $orderBy, $orderHow)
    {
        if ( trim( $orderBy ) )
            return $query -> orderBy($orderBy, $orderHow);
    }

    public function scopeStatus($query, $status)
    {
        if ( trim( $status ) )
            return $query -> where('status', $status);
    }

    public function scopeMinPrice($query, $minPrice)
    {
        if ( trim( $minPrice ) ) {
            return $query -> where('price_cost', '>=', $minPrice);
        }
    }

    public function scopeMaxPrice($query, $maxPrice)
    {
        if ( trim( $maxPrice ) ) {
            return $query -> where('price_cost', '<=', $maxPrice);
        }
    }


    //URL friendly
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
