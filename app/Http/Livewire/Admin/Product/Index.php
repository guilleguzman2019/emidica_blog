<?php

namespace App\Http\Livewire\Admin\Product;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Imports\ProductsImport;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search, $category_id, $order_list, $status, $excel, $paginate = 20;
    public $editPrice = [
        'category_id' => NULL,
        'type' => 1,
        'percent' => null
    ];

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');
    }

    public function updatedSearch()
    {
        $this -> resetPage();
    }

    public function updatedStatus()
    {
        $this -> resetPage();
    }

    public function updatedCategoryId()
    {
        $this -> resetPage();
    }

    public function updatedOrderList()
    {
        $this -> resetPage();
    }

    public function delete(Product $product)
    {
        $product -> slug = $product -> slug . '-trash';
        $product -> sku = $product -> sku . '-trash';
        $product -> save();
        $product -> delete();
        $this -> resetPage();
    }

    public function updatePrice()
    {
        $this -> validate([
            'editPrice.category_id' => 'required',
            'editPrice.type' => 'required',
            'editPrice.percent' => 'required'
        ]);

        $products = Product::categoryId( $this -> editPrice['category_id'] ) -> get();
        foreach ($products as $product) {
            if ( $this -> editPrice['type'] == 1 ) { $price_cost = $product -> price_cost + ($product -> price_cost * $this -> editPrice['percent'] / 100); }
            if ( $this -> editPrice['type'] == 2 ) { $price_cost = $product -> price_cost - ($product -> price_cost * $this -> editPrice['percent'] / 100); }

            $product -> price_cost = $price_cost;
            $product -> save();
        }

        $this -> reset('editPrice');
        $this -> emit('updated');
    }

    public function importExcel()
    {
        $this -> validate([ 'excel' => 'required' ]);
        Excel::import( new ProductsImport, $this -> excel );
        $this -> emit('updated');
    }

    public function render()
    {

        $paginate = $this -> paginate;
        $settings = Setting::first();
        $products = Product::search($this -> search)
                          -> categoryId( $this -> category_id )
                          -> orderList( $this -> order_list ?? 'id' )
                          -> status( $this -> status )
                          -> paginate( $paginate );
        $categories = Category::with('descendants') -> whereNull('parent_id') -> get();

        return view('livewire.admin.product.index', compact('settings', 'products', 'categories'));
    }
}
