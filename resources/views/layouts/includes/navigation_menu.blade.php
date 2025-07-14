<!-- Navigation -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Mobile menu button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="md:hidden text-gray-500 hover:text-blue-600 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <div class="flex items-center">
                <a href="{{ route('client.home') }}" rel="noopener noreferrer">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-blue-600">EasyProtection</h1>
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

                    </div>
                </div>
            </div>

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
            <div class="flex items-center space-x-2 sm:space-x-4">

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
                    <a href="{{ route('client.profile') }}" wire:navigate class="text-sm text-gray-500 hover:text-blue-600 font-medium">Profile</a>

                    <!-- Logout Button -->
                    <button wire:click="logout"
                            class="ml-4 text-sm text-red-600 hover:text-red-700 font-medium px-4 py-2 rounded-lg transition">
                        Logout
                    </button>
                @else
                    <!-- Direct Links -->
                    <a href="/login" class="text-sm text-gray-500 hover:text-blue-600 font-medium">Login</a>
                    <a href="/register"
                        class="ml-2 text-sm bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                        Signup
                    </a>
                @endif
            </div>


        </div>
    </div>

    <!-- Mobile Search Bar -->
    <div class="sm:hidden px-4 pb-4" x-data="{ search: '' }">
        <div class="relative">
            <input type="text" x-model="search" placeholder="Search products..."
                class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <i class="fas fa-search text-gray-400"></i>
            </div>
        </div>
    </div>
</nav>


<!-- Mobile Menu -->
<div class="md:hidden fixed inset-0 z-40" :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }">
    <div class="fixed inset-0 bg-black bg-opacity-50" @click="mobileMenuOpen = false"></div>
    <div class="mobile-menu fixed left-0 top-0 h-full w-64 bg-white shadow-lg" :class="{ 'open': mobileMenuOpen }">
        <div class="p-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-bold text-blue-600">Menu</h2>
                <button @click="mobileMenuOpen = false" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <nav class="space-y-4">
                <a href="#" class="block text-gray-900 hover:text-blue-600 py-2 text-lg font-medium">Home</a>
                <a href="#" class="block text-gray-500 hover:text-blue-600 py-2 text-lg font-medium">Categories</a>
                <a href="#" class="block text-gray-500 hover:text-blue-600 py-2 text-lg font-medium">Products</a>
                <a href="#" class="block text-gray-500 hover:text-blue-600 py-2 text-lg font-medium">About</a>
                <a href="#" class="block text-gray-500 hover:text-blue-600 py-2 text-lg font-medium">Contact</a>
                @if (auth()->check() && auth()->user()->role === 'client')
                    <a href="{{ route('client.profile') }}" wire:navigate class="block text-gray-900 hover:text-blue-600 py-2 text-lg font-medium">Profile</a>
                    <button wire:click="logout"
                        class="w-full text-left text-red-600 hover:text-red-700 py-2 text-lg font-medium rounded transition">
                        Logout
                    </button>
                @else
                    <a href="/login" class="block text-gray-500 hover:text-blue-600 py-2 text-lg font-medium">Login</a>
                    <a href="/register" class="block text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-lg font-semibold transition">Signup</a>
                @endif
            </nav>
        </div>
    </div>

</div>
