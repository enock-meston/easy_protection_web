<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;

class CategoryProducts extends Component
{
    public $category;
    public $products;

    public function mount($id)
    {
        $this->category = Category::findOrFail($id);
        $this->products = Product::where('category_id', $id)->where('status', 'active')->get();
    }

    #[Layout('layouts.home_layout')]
    public function render()
    {
        return view('livewire.category-products');
    }
}
