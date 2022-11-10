<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductController extends Controller
{
    
    public function __invoke(Request $request, Product $product)
    {

        $request -> validate([
            'file' => 'required|image|mimes:png,jpg,jpeg|max:4096'
        ]);

        $img = Storage::disk('public') -> put('img/products', $request -> file('file'));

        $product -> images() -> create([
            'url' => $img
        ]);
    }

}
