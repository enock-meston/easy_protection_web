<div>
    <!-- Dashboard Content -->
    <div class="p-6 space-y-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-sm p-6 card-hover border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalRevenue }} Rwf</p>
                        <p class="text-xs text-green-600 mt-1">
                            {{-- <i class="fas fa-arrow-up"></i> +12.5% from last month --}}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-dollar-sign text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Orders</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalOrders }}</p>
                        <p class="text-xs text-green-600 mt-1">
                            {{-- <i class="fas fa-arrow-up"></i> +8.2% from last month --}}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Customers</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalCustomers }}</p>
                        <p class="text-xs text-green-600 mt-1">
                            {{-- <i class="fas fa-arrow-up"></i> +23.1% from last month --}}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-purple-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover border-l-4 border-red-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Low Stock Alert</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalMessages }}</p>
                        <p class="text-xs text-red-600 mt-1">
                            <i class="fas fa-exclamation-triangle"></i> Requires attention
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-box text-red-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Top Products -->
            {{-- <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Selling Products</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-200 rounded-lg"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Wireless Headphones</p>
                            <p class="text-xs text-gray-500">Electronics</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">$2,340</p>
                            <p class="text-xs text-gray-500">156 sold</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-200 rounded-lg"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Smart Watch</p>
                            <p class="text-xs text-gray-500">Electronics</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">$1,890</p>
                            <p class="text-xs text-gray-500">89 sold</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-200 rounded-lg"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Laptop Stand</p>
                            <p class="text-xs text-gray-500">Accessories</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">$1,234</p>
                            <p class="text-xs text-gray-500">234 sold</p>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
                    <a href="{{ route('admin.client-orders') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">View All</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider px-6 py-3">
                                Order</th>
                            <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider px-6 py-3">
                                Customer</th>
                            <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider px-6 py-3">
                                Date</th>
                            <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider px-6 py-3">
                                Status</th>
                            <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider px-6 py-3">
                                Total</th>
                            {{-- <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider px-6 py-3">
                                Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentOrders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">#ORD-{{ $order->id }}</div>
                                    <div class="text-sm text-gray-500">{{ $order->quantity ?? 'N/A' }} items</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gray-300 rounded-full mr-3"></div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $order->name ?? 'Unknown' }}</div>
                                            <div class="text-sm text-gray-500">{{ $order->user_email ?? $order->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $order->created_at ? \Carbon\Carbon::parse($order->created_at)->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $status = strtolower($order->status ?? 'pending');
                                        $statusMap = [
                                            'successful' => ['status-shipped', 'Shipped', 'fas fa-check-circle'],
                                            'pending' => ['status-pending', 'Pending', 'fas fa-clock'],
                                            'cancelled' => ['status-canceled', 'Canceled', 'fas fa-times-circle'],
                                            'failed' => ['status-canceled', 'Failed', 'fas fa-times-circle'],
                                        ];
                                        $badge = $statusMap[$status] ?? $statusMap['pending'];
                                    @endphp
                                    <span class="status-badge {{ $badge[0] }}">
                                        <i class="{{ $badge[2] }}"></i>
                                        {{ $badge[1] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ isset($order->amount) ? '$' . number_format($order->amount, 2) : 'N/A' }}
                                </td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">View</button>
                                    <button class="text-gray-600 hover:text-gray-900">Edit</button>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No recent orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
