<div>
    {{-- Enhanced Hero Section --}}
    <section id="home" class="hero-bg text-white py-20 lg:py-32 relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-xl animate-float">
            </div>
            <div class="absolute top-32 right-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl animate-float"
                style="animation-delay: 2s;"></div>
            <div class="absolute bottom-10 left-32 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl animate-float"
                style="animation-delay: 4s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                {{-- Enhanced Text Content --}}
                <div class="text-center lg:text-left space-y-8">
                    <div
                        class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm font-medium text-blue-100 mb-4 animate-slide-in">
                        <i class="fas fa-star text-yellow-400 mr-2"></i>
                        Trusted by 50,000+ customers worldwide
                    </div>

                    <h1 class="hero-text text-4xl sm:text-5xl lg:text-7xl font-bold leading-tight animate-slide-in">
                        Premium Products, <br class="hidden sm:block">
                        <span class="bg-gradient-to-r from-blue-200 to-white bg-clip-text text-transparent">
                            Exceptional Experience
                        </span>
                    </h1>

                    <p class="text-xl lg:text-2xl text-blue-100 leading-relaxed animate-slide-in"
                        style="animation-delay: 0.2s;">
                        Discover our curated collection of high-quality products designed to enhance your lifestyle with
                        premium materials and innovative design.
                    </p>

                    {{-- Enhanced Stats --}}
                    <div class="grid grid-cols-3 gap-4 py-6 animate-slide-in" style="animation-delay: 0.3s;">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">50k+</div>
                            <div class="text-sm text-blue-200">Happy Customers</div>
                        </div>
                        <div class="text-center border-x border-blue-300/30">
                            <div class="text-2xl font-bold text-white">1000+</div>
                            <div class="text-sm text-blue-200">Premium Products</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">99%</div>
                            <div class="text-sm text-blue-200">Satisfaction Rate</div>
                        </div>
                    </div>

                    {{-- Enhanced CTA Buttons --}}
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start animate-slide-in"
                        style="animation-delay: 0.4s;">
                        <button
                            class="group relative bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center">
                                <i class="fas fa-shopping-bag mr-2"></i>
                                Shop Now
                            </span>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <span
                                class="absolute inset-0 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
                                <i class="fas fa-shopping-bag mr-2"></i>
                                Shop Now
                            </span>
                        </button>

                        <button
                            class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            <i class="fas fa-play mr-2"></i>
                            Watch Demo
                        </button>
                    </div>
                </div>

                {{-- Enhanced Slideshow --}}
                <div x-data="{
                    current: 0,
                    images: [{
                            url: 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&h=600&fit=crop',
                            title: 'Premium Collection'
                        },
                        {
                            url: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=800&h=600&fit=crop',
                            title: 'Latest Technology'
                        },
                        {
                            url: 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=800&h=600&fit=crop',
                            title: 'Lifestyle Products'
                        }
                    ],
                    autoplay: true
                }" x-init="if (autoplay) {
                    setInterval(() => {
                        current = (current + 1) % images.length
                    }, 5000)
                }"
                    class="relative w-full h-80 md:h-96 lg:h-[500px] animate-slide-in" style="animation-delay: 0.6s;">

                    {{-- Main Slideshow Container --}}
                    <div class="relative w-full h-full rounded-2xl overflow-hidden shadow-2xl">
                        <template x-for="(image, index) in images" :key="index">
                            <div x-show="current === index"
                                x-transition:enter="transition-opacity duration-1000 ease-in-out"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition-opacity duration-1000 ease-in-out"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="absolute inset-0 bg-cover bg-center"
                                :style="'background-image: url(' + image.url + ')'">

                                {{-- Overlay --}}
                                <div class="absolute inset-0 bg-black/20"></div>

                                {{-- Image Title --}}
                                <div class="absolute bottom-6 left-6 text-white">
                                    <h3 class="text-xl font-bold" x-text="image.title"></h3>
                                </div>
                            </div>
                        </template>

                        {{-- Navigation Arrows --}}
                        <button @click="current = current > 0 ? current - 1 : images.length - 1"
                            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300 hover:scale-110">
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <button @click="current = (current + 1) % images.length"
                            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300 hover:scale-110">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>

                    {{-- Enhanced Indicators --}}
                    <div class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2">
                        <template x-for="(image, index) in images" :key="index">
                            <button @click="current = index"
                                class="w-3 h-3 rounded-full transition-all duration-300 transform hover:scale-125"
                                :class="current === index ? 'bg-white shadow-lg' : 'bg-white/50 hover:bg-white/70'">
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Enhanced Features Section --}}
    <section class="py-20 bg-white relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-0 w-full h-full"
                style="background-image: radial-gradient(circle at 1px 1px, #3b82f6 1px, transparent 0); background-size: 20px 20px;">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Why Choose Us</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Experience the difference with our premium service
                    standards and commitment to excellence</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Free Shipping --}}
                <div
                    class="group text-center p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    <div
                        class="feature-icon w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-shipping-fast text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Free Shipping</h3>
                    <p class="text-gray-600 leading-relaxed">Complimentary shipping on all orders over $50 with express
                        delivery options available</p>
                </div>

                {{-- Secure Payment --}}
                <div
                    class="group text-center p-8 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-shield-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Secure Payment</h3>
                    <p class="text-gray-600 leading-relaxed">Bank-level encryption and multiple secure payment options
                        for
                        your peace of mind</p>
                </div>

                {{-- Easy Returns --}}
                <div
                    class="group text-center p-8 rounded-2xl bg-gradient-to-br from-purple-50 to-violet-50 hover:from-purple-100 hover:to-violet-100 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-purple-500 to-violet-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-undo-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Easy Returns</h3>
                    <p class="text-gray-600 leading-relaxed">Hassle-free 30-day return policy with free return shipping
                        on
                        all items</p>
                </div>

                {{-- 24/7 Support --}}
                <div
                    class="group text-center p-8 rounded-2xl bg-gradient-to-br from-orange-50 to-red-50 hover:from-orange-100 hover:to-red-100 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-headset text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">24/7 Support</h3>
                    <p class="text-gray-600 leading-relaxed">Round-the-clock customer support via chat, email, and phone
                        assistance</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Enhanced Categories Section --}}
    <section id="categories" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Shop by Category</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Explore our carefully curated collection across
                    diverse
                    product categories, each selected for quality and style</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($categories as $category)
                    <div
                        class="group category-hover bg-white rounded-2xl shadow-lg overflow-hidden cursor-pointer border border-gray-100">
                        <div class="h-64 overflow-hidden relative">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent">
                            </div>
                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-semibold text-gray-800">
                                {{ rand(100, 500) }}+ Items
                            </div>
                        </div>
                        <div class="p-6">
                            <h3
                                class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                {{ $category->name }}
                            </h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($category->description, 80) }}</p>
                            <a href="#"
                                class="text-blue-600 font-semibold hover:text-blue-800 transition-colors inline-flex items-center">
                                Shop Now <i
                                    class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- Enhanced Featured Products --}}
    <section id="products" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Featured Products</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Handpicked favorites from our premium collection,
                    chosen for their exceptional quality and customer satisfaction
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

                @foreach ($products as $product)
                    <a href="{{ route('product.details', $product->slug) }}"
                        class="group product-card bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:border-blue-200 block">
                        <div
                            class="group product-card bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:border-blue-200">
                            <div class="h-64 overflow-hidden relative">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />

                                
                            </div>

                            <div class="p-6">
                                <h3
                                    class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                    {{ $product->name }}
                                </h3>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xl font-bold text-red-600">{{ $product->price }} Rwf</span>
                                    </div>

                                </div>
                                 {{-- <button
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold text-sm transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                        <i class="fas fa-shopping-cart mr-1"></i>Add to Cart
                                    </button> --}}
                            </div>
                        </div>
                    </a>
                @endforeach

            </div> <!-- End of grid -->
        </div> <!-- End of container -->
    </section> <!-- End of Featured Products Section -->

</div>
