<div>
    {{-- center --}}
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">My Orders</h2>
            <p class="text-gray-600 mt-1">View your order history and transaction details</p>
        </div>

        <!-- Order Summary -->
        <div class="mb-6 bg-white p-4 rounded-lg shadow-sm border">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600">{{ $orders->count() }}</div>
                    <div class="text-sm text-gray-600">Total Orders</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">{{ $orders->where('status', 'successful')->count() }}
                    </div>
                    <div class="text-sm text-gray-600">Successful</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-yellow-600">{{ $orders->where('status', 'pending')->count() }}
                    </div>
                    <div class="text-sm text-gray-600">Pending</div>
                </div>
                {{-- cancelled --}}
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-600">{{ $orders->where('status', 'cancelled')->count() }}
                    </div>
                    <div class="text-sm text-gray-600">Cancelled</div>
                </div>

                <div class="text-center">
                    <div class="text-2xl font-bold text-red-600">{{ $orders->where('status', 'failed')->count() }}</div>
                    <div class="text-sm text-gray-600">Failed</div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Transaction
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Payment Status
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <div class="text-sm font-medium text-gray-900">{{ $order->tx_ref }}</div>
                                        <div class="text-sm text-gray-500">Qty: {{ $order->quantity }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <div class="text-sm font-medium text-gray-900">{{ $order->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $order->email }}</div>
                                        <div class="text-sm text-gray-500">{{ $order->phone }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $order->amount }}</div>
                                    <div class="text-sm text-gray-500">{{ strtoupper($order->currency) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($order->status === 'successful')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-2 h-2 mr-1 fill-current" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Successful
                                        </span>
                                    @elseif($order->status === 'pending')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="w-2 h-2 mr-1 fill-current" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Pending
                                        </span>
                                    @elseif($order->status === 'failed')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-2 h-2 mr-1 fill-current" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Failed
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <svg class="w-2 h-2 mr-1 fill-current" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button wire:click="viewOrder({{ $order->id }})"
                                            class="text-blue-600 hover:text-blue-900 p-1 rounded-full hover:bg-blue-50 transition-colors"
                                            title="View Details">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </button>
                                        @if ($order->status === 'successful')
                                            <button
                                                class="text-green-600 hover:text-green-900 p-1 rounded-full hover:bg-green-50 transition-colors"
                                                title="Download Receipt">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <p class="text-lg font-medium">No orders found</p>
                                        <p class="text-sm">You haven't placed any orders yet</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($showModal)
                    <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50"
                        wire:key="modal">
                        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
                            <button wire:click="closeModal"
                                class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-2xl font-bold">
                                &times;
                            </button>

                            <h3 class="text-lg font-semibold mb-4">Order Details</h3>
                            @if ($selectedOrder)
                                <div class="space-y-3">
                                    <div class="border-b pb-3">
                                        <h4 class="font-medium text-gray-900 mb-2">Transaction Information</h4>
                                        <p><strong>Transaction Ref:</strong> {{ $selectedOrder->tx_ref }}</p>
                                        <p><strong>Amount:</strong> {{ $selectedOrder->amount }} {{ strtoupper($selectedOrder->currency) }}</p>
                                        <p><strong>Quantity:</strong> {{ $selectedOrder->quantity }}</p>
                                        <p><strong>Status:</strong> {{ ucfirst($selectedOrder->status) }}</p>
                                        <p><strong>Payment Status:</strong> {{ ucfirst($selectedOrder->payment_status) }}</p>
                                    </div>

                                    <div class="border-b pb-3">
                                        <h4 class="font-medium text-gray-900 mb-2">Customer Information</h4>
                                        <p><strong>Name:</strong> {{ $selectedOrder->name }}</p>
                                        <p><strong>Email:</strong> {{ $selectedOrder->email }}</p>
                                        <p><strong>Phone:</strong> {{ $selectedOrder->phone }}</p>
                                    </div>

                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-2">Shipping Address</h4>
                                        @if($selectedOrder->address || $selectedOrder->street || $selectedOrder->city || $selectedOrder->province || $selectedOrder->country || $selectedOrder->postal_code)
                                            <div class="text-sm text-gray-700">
                                                @if($selectedOrder->address)
                                                    <p>{{ $selectedOrder->address }}</p>
                                                @endif
                                                @if($selectedOrder->street)
                                                    <p>{{ $selectedOrder->street }}</p>
                                                @endif
                                                @if($selectedOrder->city || $selectedOrder->province)
                                                    <p>{{ $selectedOrder->city }}{{ $selectedOrder->city && $selectedOrder->province ? ', ' : '' }}{{ $selectedOrder->province }}</p>
                                                @endif
                                                @if($selectedOrder->country)
                                                    <p>{{ $selectedOrder->country }}</p>
                                                @endif
                                                @if($selectedOrder->postal_code)
                                                    <p>{{ $selectedOrder->postal_code }}</p>
                                                @endif
                                            </div>
                                        @else
                                            <p class="text-gray-500 italic">No address information available</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

            </div>

            <!-- Pagination -->
            @if (method_exists($orders, 'hasPages') && $orders->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>

        <!-- Loading State -->
        <div wire:loading class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 shadow-lg">
                <div class="flex items-center space-x-3">
                    <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                    <span class="text-gray-700">Loading...</span>
                </div>
            </div>
        </div>

    </div>
</div>
