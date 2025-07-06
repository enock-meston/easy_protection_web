<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class HomePage extends Component
{

    #[Layout('layouts.home_layout')]
    public function render()
    {
        $categories = Category::latest()->take(4)->get();
        //Fetch featured products or 20 products if no featured flag
        $products = Product::where('status', 'active')->latest()->take(20)->get();
        Auth::user() ? Auth::user()->name : 'Guest';
        return view('livewire.home-page', [
            'categories' => $categories,
            'products' => $products,

        ]);


    }
}
