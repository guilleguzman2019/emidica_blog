<?php

namespace App\Http\Livewire\Admin\Product;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Setting;

class Create extends Component
{
    use WithFileUploads;

    public $categories, $brands, $image;
    public $createArray = [
        'name' => null,
        'slug' => null,
        'sku' => null,
        'description' => null,
        'price_regular' => null,
        'price_sale' => null,
        'price_cost' => null,
        'variation' => null,
        'weight' => null,
        'size' => null,
        'quantity' => null,
        'featured' => 0,
        'status' => 1,
        'category_id' => null,
        'brand_id' => null
    ];

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');

        $this -> categories = Category::where('parent_id', NULL) -> orderBy('name') -> get();
        $this -> brands = Brand::orderBy('name') -> get();
    }

    public function updatedCreateArrayName($value)
    {
        $this -> createArray['slug'] = Str::slug($value);
    }

    public function save()
    {
        $settings = Setting::first();

        $toValidate = [
            'createArray.name' => 'required',
            'createArray.slug' => 'required|unique:products,slug',
            'createArray.sku' => 'required|unique:products,sku',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'createArray.description' => 'required',
            'createArray.price_regular' => 'required',
            'createArray.price_cost' => 'required',
            'createArray.variation' => 'required',
            'createArray.category_id' => 'required',
        ];

        if ( $this -> createArray['variation'] == 1 ) {
            $toValidate['createArray.quantity'] = 'required';
        }

        $this -> validate($toValidate);

        //CALCULO EL PRECIO EN ARS
        $price_regular = (($this -> createArray['price_cost'] * $settings -> dolar) * $this -> createArray['price_regular']/100) + ($this -> createArray['price_cost'] * $settings -> dolar);

        if ( $this -> createArray['price_sale'] ) :
            $price_ars = $price_regular - ($price_regular * $this -> createArray['price_sale']/100);
        else:
            $price_ars = $price_regular;
        endif;

        $this -> createArray['price_ars'] = $price_ars;
        //end CALCULO EL PRECIO EN ARS

        if ( $this -> image ) {
            $this -> createArray['image'] = $this -> image -> store('img/products');
        }

        $product = Product::create( $this -> createArray );

        return redirect() -> route('admin.products.edit', $product);
    }

    public function render()
    {
        return view('livewire.admin.product.create');
    }
}

























