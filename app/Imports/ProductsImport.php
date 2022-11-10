<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{

    public function model(array $row)
    {
        return new Product([
            'id' => 0,
            'name' => $row[0],
            'slug' => $row[1],
            'sku' => $row[2],
            'image' => NULL,
            'description' => $row[3],
            'price_regular' => $row[4],
            'price_sale' => $row[5],
            'price_cost' => $row[6],
            'price_ars' => 0,
            'variation' => 1,
            'weight' => $row[7],
            'size' => $row[8],
            'quantity' => $row[9],
            'views' => 0,
            'sales' => 0,
            'featured' => 0,
            'status' => 1,
            'category_id' => 8,
            'brand_id' => NULL,
            'deleted_at' => NULL,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL
        ]);
    }
}
