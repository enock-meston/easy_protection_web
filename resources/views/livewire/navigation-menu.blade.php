<div>
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full z-50 ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden text-gray-500 hover:text-blue-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <div class="flex items-center">
                    <a href="{{ route('client.home') }}" wire:navigate rel="noopener noreferrer"
                        class="flex items-center space-x-3 group">
                        {{-- Logo Image --}}
                        <img src="{{ asset('images/logo.png') }}" alt="EasyProtection Logo"
                            class="h-10 w-10 object-contain rounded-full shadow-md group-hover:scale-105 transition duration-300 ease-in-out">

                        {{-- Brand Text --}}
                        <div class="flex-shrink-0">
                            <h1
                                class="text-2xl font-bold text-blue-600 group-hover:text-blue-800 transition duration-300 ease-in-out">
                                EasyProtection
                            </h1>
                        </div>
                    </a>

                    <div class="hidden md:block ml-10">
                        <div class="flex items-baseline space-x-4">
                            <a href="/#home"
                                class="text-gray-900 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                            <a href="/#categories"
                                class="text-gray-500 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Categories</a>
                            <a href="/#products"
                                class="text-gray-500 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Products</a>
                            <a href="/#about"
                                class="text-gray-500 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">About</a>
                            <a href="/#contact"
                                class="text-gray-500 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Contact</a>

                            <!-- Search Bar -->
                            <div class="flex-1 max-w-lg mx-2 sm:mx-4 hidden sm:block" x-data="{ search: '' }">
                                <div class="relative">
                                    <input type="text" x-model="search" placeholder="Search products..."
                                        class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Side Icons -->
                            <div class="flex items-center space-x-2 sm:space-x-4 relative">

                                <div id="cart-dropdown"
                                    class="bg-white shadow-md p-4 rounded-lg w-80 hidden absolute right-0 mt-2 z-50">
                                    <h4 class="text-lg font-bold mb-2">Cart Items</h4>
                                    <ul id="cart-items-list" class="space-y-2">
                                        <!-- JS will inject items here -->
                                    </ul>
                                    <div id="cart-total" class="text-right font-semibold mt-4">
                                        Total: 0 RWF
                                    </div>

                                    <div class="flex justify-between items-center mt-4">
                                        <button id="clear-cart" class="text-red-600 hover:underline text-sm">
                                            🗑 Clear Cart
                                        </button>
                                        <button id="close-cart" class="text-gray-500 hover:text-black text-sm">
                                            ✖ Close
                                        </button>
                                    </div>

                                    <div class="mt-4">
                                        <button id="buy-now"
                                            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded">
                                            🛒 Buy Now
                                        </button>
                                    </div>
                                </div>

                                <!-- Toggle Cart Button -->
                                <button id="toggle-cart" class="text-gray-500 hover:text-blue-600 relative">
                                    <i class="fas fa-shopping-cart text-lg sm:text-xl"></i>
                                    <span id="cart-count"
                                        class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs rounded-full h-4 w-4 sm:h-5 sm:w-5 flex items-center justify-center">
                                        0
                                    </span>
                                </button>

                                {{-- check is client role is there --}}
                                @if (auth()->check() && auth()->user()->role === 'client')
                                    {{-- display client names --}}
                                    <div class="flex items wire:navigate">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                                            <span
                                                class="text-white text-xs font-bold">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                                        </div>
                                        <div class="ml-2">
                                            <p class="text-sm font-medium">{{ auth()->user()->name ?? 'User' }}</p>
                                            <p class="text-xs text-gray-500">{{ auth()->user()->role }}</p>
                                        </div>
                                    </div>
                                    {{--  profile button --}}
                                    <a href="{{ route('client.profile') }}"
                                        class="text-sm text-gray-500 hover:text-blue-600 font-medium">Profile</a>

                                    {{-- my orders --}}
                                    <a href="{{ route('client.orders') }}"
                                        class="text-sm text-gray-500 hover:text-blue-600 font-medium">Orders</a>

                                    <!-- Logout Button -->
                                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                                        @csrf
                                        <button type="submit"
                                            class="w-full group flex items-center justify-center space-x-2 px-4 py-2 bg-red-600/20 hover:bg-red-600 text-red-300 hover:text-white rounded-lg transition-all duration-200 border border-red-600/30 hover:border-red-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            <span class="text-sm font-medium">Logout</span>
                                        </button>
                                    </form>
                                @else
                                    <!-- Direct Links -->
                                    <a href="/login"
                                        class="text-sm text-gray-500 hover:text-blue-600 font-medium">Login</a>
                                    <a href="/register"
                                        class="ml-2 text-sm bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                                        Signup
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Enhanced Mobile Menu -->
    <div class="md:hidden fixed inset-0 z-40" :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }">
        <!-- Enhanced backdrop with blur -->
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity duration-300" @click="mobileMenuOpen = false"></div>

        <!-- Enhanced mobile menu panel -->
        <div class="mobile-menu fixed left-0 top-0 h-full w-80 bg-gradient-to-br from-white via-blue-50/30 to-white shadow-2xl transform transition-transform duration-300 ease-out"
             :class="{ 'translate-x-0 open': mobileMenuOpen, '-translate-x-full': !mobileMenuOpen }">

            <!-- Enhanced header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6 shadow-lg">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bars text-white text-sm"></i>
                        </div>
                        <h2 class="text-xl font-bold text-white">Menu</h2>
                    </div>
                    <button @click="mobileMenuOpen = false"
                            class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-lg flex items-center justify-center transition-colors duration-200">
                        <i class="fas fa-times text-white text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Enhanced Cart Section with proper positioning -->
                <div class="mb-6 relative">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Shopping</h3>

                    <!-- Mobile Cart Dropdown - Fixed positioning -->
                    <div id="mobile-cart-dropdown"
                        class="bg-white shadow-lg border border-gray-100 p-4 rounded-xl mb-4 hidden">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-lg font-bold text-gray-800">Cart Items</h4>
                            <button id="mobile-close-cart" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <ul id="mobile-cart-items-list" class="space-y-3 max-h-40 overflow-y-auto">
                            <!-- JS will inject items here -->
                        </ul>
                        <div id="mobile-cart-total" class="text-right font-bold text-lg mt-4 pt-3 border-t border-gray-100">
                            Total: 0 RWF
                        </div>
                        <div class="flex justify-between items-center mt-4 space-x-2">
                            <button id="mobile-clear-cart" class="flex-1 text-red-600 hover:bg-red-50 hover:text-red-700 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                                <i class="fas fa-trash-alt mr-1"></i>Clear Cart
                            </button>
                            <button id="mobile-buy-now"
                                class="flex-2 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                                <i class="fas fa-shopping-cart mr-1"></i>Buy Now
                            </button>
                        </div>
                    </div>

                    <!-- Enhanced Mobile Cart Toggle Button -->
                    <button id="mobile-toggle-cart" class="w-full flex items-center justify-between px-4 py-3 bg-gray-50 hover:bg-blue-50 rounded-xl border border-gray-200 hover:border-blue-200 transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <i class="fas fa-shopping-cart text-gray-600 group-hover:text-blue-600 text-lg"></i>
                                <span id="mobile-cart-count"
                                    class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center shadow-md min-w-[20px]">
                                    0
                                </span>
                            </div>
                            <span class="font-medium text-gray-700 group-hover:text-blue-600">Shopping Cart</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                    </button>
                </div>

                <!-- Enhanced User Section with your original logic -->
                <div>
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Account</h3>

                    {{-- check is client role is there --}}
                    @if (auth()->check() && auth()->user()->role === 'client')
                        {{-- display client names --}}
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-xl border border-purple-100 mb-4">
                            <div class="flex items-center space-x-3 wire:navigate">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-md">
                                    <span class="text-white text-lg font-bold">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'User' }}</p>
                                    <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            {{--  profile button --}}
                            <a href="{{ route('client.profile') }}"
                                class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200 border border-transparent hover:border-purple-100 group">
                                <i class="fas fa-user text-sm w-5 group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium">Profile</span>
                            </a>

                            {{-- my orders --}}
                            <a href="{{ route('client.orders') }}"
                                class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200 border border-transparent hover:border-purple-100 group">
                                <i class="fas fa-shopping-bag text-sm w-5 group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium">My Orders</span>
                            </a>

                            <!-- Enhanced Logout Button -->
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center justify-center space-x-2 px-4 py-3 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white rounded-xl transition-all duration-200 border border-red-200 hover:border-red-600 group">
                                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    <span class="font-medium">Logout</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Enhanced Guest Actions -->
                        <div class="space-y-2">
                            <a href="/login" class="flex items-center justify-center space-x-2 px-4 py-3 bg-gray-50 hover:bg-blue-50 text-gray-700 hover:text-blue-600 rounded-xl transition-all duration-200 border border-gray-200 hover:border-blue-200 group">
                                <i class="fas fa-sign-in-alt text-sm group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium">Login</span>
                            </a>
                            <a href="/register"
                                class="flex items-center justify-center space-x-2 px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl transition-all duration-200 shadow-md hover:shadow-lg group">
                                <i class="fas fa-user-plus text-sm group-hover:scale-110 transition-transform"></i>
                                <span class="font-semibold">Sign Up</span>
                            </a>
                        </div>
                    @endif
                </div>


            <!-- Scrollable content with enhanced scroll -->
            <div class="flex-1 overflow-y-auto p-4 scrollbar-thin scrollbar-thumb-blue-300 scrollbar-track-gray-100">
                <!-- Enhanced Navigation -->
                <nav class="space-y-2 mb-6">
                    <a href="/#home"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 border border-transparent hover:border-blue-100 group">
                        <i class="fas fa-home text-sm w-5 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Home</span>
                    </a>
                    <a href="/#categories"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 border border-transparent hover:border-blue-100 group">
                        <i class="fas fa-th-large text-sm w-5 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Categories</span>
                    </a>
                    <a href="/#products"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 border border-transparent hover:border-blue-100 group">
                        <i class="fas fa-box text-sm w-5 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Products</span>
                    </a>
                    <a href="/#about"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 border border-transparent hover:border-blue-100 group">
                        <i class="fas fa-info-circle text-sm w-5 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">About</span>
                    </a>
                    <a href="/#contact"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 border border-transparent hover:border-blue-100 group">
                        <i class="fas fa-envelope text-sm w-5 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Contact</span>
                    </a>
                </nav>

                <!-- Enhanced Search Bar - Now visible on mobile -->
                <div class="mb-6" x-data="{ search: '' }">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Search</h3>
                    <div class="relative">
                        <input type="text" x-model="search" placeholder="Search products..."
                            class="w-full px-4 py-3 pl-12 text-gray-700 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition-all duration-200">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

