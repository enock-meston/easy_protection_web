<div class="max-w-7xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Products in Category: {{ $category->name }}
    </h2>
    @if($products->count())

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:border-blue-200 transition-all duration-300">
                    <div class="h-40 overflow-hidden relative">
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-500" />
                    </div>
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-800 mb-1">{{ $product->name }}</h3>
                        <p class="text-xs text-gray-600 mb-2">Rwf {{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('product.details', $product->slug) }}" class="text-blue-600 text-sm font-semibold hover:text-blue-800 inline-flex items-center">
                            View Details
                            <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-gray-500 text-lg font-medium py-12 text-center">No products found in this category.</div>
    @endif
</div>
