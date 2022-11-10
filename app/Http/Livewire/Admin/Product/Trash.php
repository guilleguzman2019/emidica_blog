<?php

namespace App\Http\Livewire\Admin\Product;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;

class Trash extends Component
{
    use WithPagination;

    public $search, $category_id, $order_list, $paginate = 20;

    public function mount()
    {
        if ( Auth::user() -> user_type == 4 )
            return redirect() -> route('panel.dashboard');
    }

    public function updatedSearch()
    {
        $this -> resetPage();
    }

    public function updatedCategoryId()
    {
        $this -> resetPage();
    }

    public function bringBack($slug)
    {
        $product = Product::withTrashed() -> where('slug', $slug) -> first();
        $product -> slug = substr($product -> slug, 0, -6);
        $product -> sku = substr($product -> sku, 0, -6);
        $product -> save();
        $product -> restore();
        $this -> emit('restored');
    }

    public function render()
    {
        $paginate = $this -> paginate;
        $settings = Setting::first();
        $products = Product::onlyTrashed()
                          -> search($this -> search)
                          -> categoryId( $this -> category_id )
                          -> paginate( $paginate );
        $categories = Category::with('descendants') -> whereNull('parent_id') -> get();

        return view('livewire.admin.product.trash', compact('settings', 'products', 'categories'));
    }
}
