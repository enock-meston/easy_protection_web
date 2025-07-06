<?php

namespace App\Livewire;

use App\Models\Product;
use League\CommonMark\CommonMarkConverter;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ProductDetails extends Component
{
    public Product $product;

    public function mount($slug)
    {
        $this->product = Product::with('images')->where('slug', $slug)->firstOrFail();
    }

    #[Layout('layouts.home_layout')]
    public function render()
    {
        $converter = new CommonMarkConverter();
        $descriptionHtml = $converter->convert($this->product->description)->getContent();

        return view(
            'livewire.product-details',
            [
                'product' => $this->product,
                'descriptionHtml' => $descriptionHtml,
            ]
        );
    }
}
