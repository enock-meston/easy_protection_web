<div>
    {{-- In work, do what you enjoy. --}}
    <section class="py-1 bg-gradient-to-br from-slate-50 via-white to-blue-50 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.02] pointer-events-none">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 1px 1px, rgb(0,0,0) 1px, transparent 0); background-size: 30px 30px;">
            </div>
        </div>

        <div class="py-10 relative z-10">
            <div class="max-w-7xl mx-auto px-4">
                <nav class="flex items-center space-x-2 text-sm mb-8 animate-fadeIn">
                    <a href="#" class="text-gray-500 hover:text-blue-600 transition-colors">Home</a>
                    <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
                    <a href="#" class="text-gray-500 hover:text-blue-600 transition-colors">Products</a>
                    <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
                    <span class="text-gray-900 font-medium">{{ $product->name }}</span>
                </nav>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                    <div class="animate-slideInLeft">
                        <div class="relative group">
                            <div
                                class="bg-white rounded-3xl p-8 shadow-2xl hover:shadow-3xl transition-all duration-700 transform hover:-translate-y-2">
                                <div class="absolute top-6 left-6 z-10">
                                    <span
                                        class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                        <i class="fas fa-star mr-1"></i>
                                        Premium
                                    </span>
                                </div>

                                {{-- <button class="absolute top-6 right-6 z-10 w-12 h-12 bg-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center group/heart backdrop-blur-sm">
                                    <i class="far fa-heart text-gray-400 group-hover/heart:text-red-500 group-hover/heart:scale-110 transition-all duration-300"></i>
                                </button> --}}

                                <div
                                    class="aspect-square bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl overflow-hidden relative">
                                    <img id="mainImage" src="{{ asset('storage/' . $product->thumbnail) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition-transform duration-700 hover:scale-110">

                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-10 transition-all duration-300 flex items-center justify-center">
                                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <div
                                                class="bg-white bg-opacity-90 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium">
                                                <i class="fas fa-search-plus mr-2"></i>
                                                Click to zoom
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-4 mt-6 overflow-x-auto pb-2 scrollbar-hide">
                            <img onclick="changeMainImage(this)" src="{{ asset('storage/' . $product->thumbnail) }}"
                                class="thumbnail-img w-20 h-20 object-cover rounded-xl border-2 border-gray-200 cursor-pointer hover:border-blue-500 transition-all duration-300 hover:scale-105 hover:shadow-lg flex-shrink-0 active-thumb">

                            @foreach ($product->images as $img)
                                <img onclick="changeMainImage(this)" src="{{ asset('storage/' . $img->image_path) }}"
                                    class="thumbnail-img w-20 h-20 object-cover rounded-xl border-2 border-gray-200 cursor-pointer hover:border-blue-500 transition-all duration-300 hover:scale-105 hover:shadow-lg flex-shrink-0">
                            @endforeach
                        </div>


                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h3 class="text-xl font-semibold mb-4 text-gray-900">Accepted Payment Methods</h3>
                            <div class="flex flex-wrap items-center gap-4">
                                <img src="https://images.seeklogo.com/logo-png/55/1/mtn-momo-mobile-money-uganda-logo-png_seeklogo-556395.png"
                                    alt="Mobile Money" class="h-20 object-contain">
                                <img src="https://images.seeklogo.com/logo-png/52/1/airtel-money-tanzania-logo-png_seeklogo-527192.png"
                                    alt="Mobile Money" class="h-20 object-contain">
                            </div>
                        </div>

                    </div>

                    <div class="animate-slideInRight">
                        <div class="mb-8">
                            <h1
                                class="text-3xl font-bold text-gray-900 mb-6 leading-tight bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text">
                                {{ $product->name }}
                            </h1>

                            <div class="flex items-baseline gap-4 mb-6">
                                <span
                                    class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                    Rwf {{ number_format($product->price) }}
                                </span>
                                <span
                                    class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-3 py-1 rounded-full text-sm font-semibold animate-pulse">
                                    Limited Time
                                </span>
                            </div>
                        </div>

                        <div class="mb-8">
                            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                                <h3 class="text-xl font-semibold mb-4 text-gray-900">Product Description</h3>
                                <div class="text-gray-700 text-lg leading-relaxed">
                                    {!! $descriptionHtml !!}
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h3 class="text-xl font-semibold mb-4 text-gray-900">Why Choose This Product?</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-shield-alt text-blue-600"></i>
                                    </div>
                                    <span class="text-gray-700 font-medium">Quality Guarantee</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-green-50 rounded-lg">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-shipping-fast text-green-600"></i>
                                    </div>
                                    <span class="text-gray-700 font-medium">Fast Delivery</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-purple-50 rounded-lg">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-award text-purple-600"></i>
                                    </div>
                                    <span class="text-gray-700 font-medium">Premium Quality</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-orange-50 rounded-lg">
                                    <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-headset text-orange-600"></i>
                                    </div>
                                    <span class="text-gray-700 font-medium">24/7 Support</span>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="space-y-4">
                            <div class="flex items-center gap-4">
                                <span class="text-lg font-medium text-gray-900">Quantity:</span>
                                <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                                    <button class="px-4 py-2 bg-gray-50 hover:bg-gray-100 transition-colors">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <span class="px-4 py-2 bg-white font-medium">1</span>
                                    <button class="px-4 py-2 bg-gray-50 hover:bg-gray-100 transition-colors">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <button class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
                                <span class="relative z-10">
                                    <i class="fas fa-shopping-cart mr-3"></i>
                                    Add to Cart
                                </span>
                                <div class="absolute inset-0 -top-2 -bottom-2 left-0 w-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-20 group-hover:w-full transition-all duration-700 transform skew-x-12"></div>
                            </button>
                        </div> --}}

                        <div class="space-y-4">
                            <div class="flex items-center gap-4">
                                <span class="text-lg font-medium text-gray-900">Quantity:</span>
                                <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                                    <button id="decrease"
                                        class="px-4 py-2 bg-gray-50 hover:bg-gray-100 transition-colors">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <span id="qty" class="px-4 py-2 bg-white font-medium">1</span>
                                    <button id="increase"
                                        class="px-4 py-2 bg-gray-50 hover:bg-gray-100 transition-colors">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <button id="addToCartBtn" data-product-id="{{ $product->id }}"
                                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-2xl transition-all duration-300 relative overflow-hidden group">
                                <span class="relative z-10">
                                    <i class="fas fa-shopping-cart mr-3"></i>
                                    Add to Cart
                                </span>
                                <div
                                    class="absolute inset-0 -top-2 -bottom-2 left-0 w-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-20 group-hover:w-full transition-all duration-700 transform skew-x-12">
                                </div>
                            </button>

                            <!-- Buy Now Button -->
                            <button id="buyNowBtn" data-product-id="{{ $product->id }}"
                                class="w-full mt-2 bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-2xl transition-all duration-300 relative overflow-hidden group">
                                <span class="relative z-10">
                                    <i class="fas fa-bolt mr-3"></i>
                                    Buy Now
                                </span>
                                <div
                                    class="absolute inset-0 -top-2 -bottom-2 left-0 w-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-20 group-hover:w-full transition-all duration-700 transform skew-x-12">
                                </div>
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out;
        }

        .animate-slideInLeft {
            animation: slideInLeft 0.8s ease-out;
        }

        .animate-slideInRight {
            animation: slideInRight 0.8s ease-out;
        }

        .active-thumb {
            border-color: #3b82f6 !important;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>

    <script>
        window.changeMainImage = function(thumbnail) {
            const mainImage = document.getElementById('mainImage');
            const allThumbs = document.querySelectorAll('.thumbnail-img');

            // Remove active class from all thumbnails
            allThumbs.forEach(thumb => {
                thumb.classList.remove('active-thumb');
            });

            // Add active class to clicked thumbnail
            thumbnail.classList.add('active-thumb');

            // Change main image with fade effect
            mainImage.style.opacity = '0';
            setTimeout(() => {
                mainImage.src = thumbnail.src;
                mainImage.style.opacity = '1';
            }, 150);
        }

        // Buy Now button logic
        const buyNowBtn = document.getElementById('buyNowBtn');
        if (buyNowBtn) {
            buyNowBtn.addEventListener('click', function() {
                const productId = buyNowBtn.getAttribute('data-product-id');
                fetch('/check-auth')
                    .then(res => res.json())
                    .then(data => {
                        if (data.loggedIn) {
                            window.location.href = `/buy?product_id=${productId}`;
                        } else {
                            window.location.href = '/login';
                        }
                    });
            });
        }
    </script>



</div>
