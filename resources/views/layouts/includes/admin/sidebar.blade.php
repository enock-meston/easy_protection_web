<aside id="sidebar"
            class="w-64 bg-white shadow-xl transition-transform duration-300 ease-in-out transform -translate-x-full md:translate-x-0 fixed md:relative z-40 h-full">
            <!-- Brand Header -->
            <div class="p-6 gradient-bg text-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-store text-white"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-lg">EasyProtection</h1>
                        <p class="text-xs opacity-75">Dashboard</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6 px-3">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" wire:navigate
                            class="sidebar-item active flex items-center gap-3 px-4 py-3 rounded-lg text-sm">
                            <i class="fas fa-tachometer-alt w-5"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.product') }}" wire:navigate class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg text-sm">
                            <i class="fas fa-box w-5"></i>
                            <span>Products</span>
                            <span class="ml-auto bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">234</span>
                        </a>
                    </li>
                    <li>
                        <a wire:navigate href="{{ route('admin.category') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg text-sm">
                            <i class="fas fa-list w-5"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="#orders" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg text-sm">
                            <i class="fas fa-shopping-cart w-5"></i>
                            <span>Orders</span>
                            <span
                                class="ml-auto bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full pulse-animation">5</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.customers') }}" wire:navigate class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg text-sm">
                            <i class="fas fa-users w-5"></i>
                            <span>Customers</span>
                        </a>
                    </li>

                    {{-- users --}}
                    <li>
                        <a href="{{ route('admin.users') }}" wire:navigate class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg text-sm">
                            <i class="fas fa-user-friends w-5"></i>
                            <span>Users</span>
                        </a>
                    </li>

                    <li>
                        <a href="#analytics" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg text-sm">
                            <i class="fas fa-chart-line w-5"></i>
                            <span>Analytics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile') }}" wire:navigate class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg text-sm">
                            <i class="fas fa-cog w-5"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>

                <!-- User Profile & Logout -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center gap-3 px-4 py-3 mb-3">
                        <div
                            class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-xs font-bold">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium">{{ auth()->user()->name ?? 'User' }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->role}}</p>
                        </div>
                    </div>
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full group flex items-center justify-center space-x-2 px-4 py-2 bg-red-600/20 hover:bg-red-600 text-red-300 hover:text-white rounded-lg transition-all duration-200 border border-red-600/30 hover:border-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            <span class="text-sm font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>
