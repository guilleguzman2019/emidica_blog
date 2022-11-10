<?php

namespace App\Http\Livewire\Admin\Product;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Tag;
use App\Models\ProductTag;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Image;
use App\Models\Setting;

class Edit extends Component
{
    use WithFileUploads;

    public $product, $categories, $tags, $etiquetas, $brands, $image, $slug;


    protected $listeners = ['refreshProduct'];

    protected $rules = [
        'product.name' => 'required',
        'slug' => 'required|unique:products,slug',
        'product.sku' => 'required|unique:products,sku',
        'product.image' => 'nullable',
        'image' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
        'product.description' => 'required',
        'product.price_regular' => 'required',
        'product.price_sale' => 'nullable',
        'product.price_cost' => 'required',
        'product.variation' => 'required',
        'product.weight' => 'nullable',
        'product.size' => 'nullable',
        'product.quantity' => 'nullable',
        'product.featured' => 'required',
        'product.status' => 'required',
        'product.category_id' => 'required',
        'product.brand_id' => 'nullable',
        'etiquetas' => 'nullable'
    ];

    public function mount(Product $product)
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');

        $this -> product = $product;
        $this -> slug = $this -> product -> slug;
        $this -> categories = Category::where('parent_id', NULL) -> orderBy('name') -> get();
        $this -> tags = Tag::orderBy('name') -> get();
        $this -> brands = Brand::orderBy('name') -> get();
    }

    public function updatedProductName($value)
    {
        $this -> slug = Str::slug($value);
    }

    public function save()
    {

        $settings = Setting::first();

        /* RELGAS DE VALIDACIÓN */
        $rules = $this -> rules;
        $rules['slug'] = 'required|unique:products,slug,' . $this -> product -> id;
        $rules['product.sku'] = 'required|unique:products,sku,' . $this -> product -> id;
        
        if ( empty($this -> product -> quantity) )
            $this -> product -> quantity = NULL;

        $this -> validate($rules);

        //CALCULO EL PRECIO EN ARS
        $price_regular = (($this -> product -> price_cost * $settings -> dolar) * $this -> product -> price_regular/100) + ($this -> product -> price_cost * $settings -> dolar);

        if ( $this -> product -> price_sale ) :
            $price_ars = $price_regular - ($price_regular * $this -> product -> price_sale/100);
        else:
            $price_ars = $price_regular;
        endif;

        $this -> product -> price_ars = $price_ars;
        //end CALCULO EL PRECIO EN ARS

        // coloco precio en null si no tiene valo o es 0
        if ( $this -> product -> price_sale == 0 || empty($this -> product -> price_sale) ) {
            $this -> product -> price_sale = NULL;
        }

        //cargo imagen
        if ( $this -> image ) {
            Storage::disk('public') -> delete( $this -> product -> image );
            $this -> product -> image = $this -> image -> store('img/products');
        }
    
        //guardo
        $this -> product -> slug = $this -> slug;
        $this -> product -> save();
        $this -> refreshProduct();

        //elimino variaciones si no tiene variación
        if ( $this -> product -> variation == 1 ){
            foreach ($this -> product -> colors as $color) { $color -> delete(); }
            foreach ($this -> product -> sizes as $size) { $size -> delete(); }
        }

        //elimino tags relacionados y creo los nuevos
        if ( $this -> product -> productTags ) {
            foreach ($this -> product -> productTags as $productTag) {
                $productTag -> delete();
            }
        }
        if ( count( $this -> etiquetas ) ) {
            foreach ($this -> etiquetas as $etiq) {
                ProductTag::create([
                    'product_id' => $this -> product -> id,
                    'tag_id' => $etiq
                ]);
            }
        }
 
        $this -> emit('saved');
    }

    public function deleteImage(Image $image)
    {
        Storage::disk('public') -> delete($image -> url);
        $image -> delete();
        $this -> refreshProduct();
    }

    public function refreshProduct()
    {
        $this -> product = $this -> product -> fresh();
    }

    public function render()
    {
        return view('livewire.admin.product.edit');
    }
}
