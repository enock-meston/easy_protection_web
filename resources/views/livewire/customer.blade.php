<div>
    <div class="p-6 bg-white shadow rounded-xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Active Clients</h2>

            <input type="text" placeholder="Search by name or email..." wire:model.live.debounce.300ms="search"
                class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400 w-64" />
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">#</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Phone</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Country</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">City</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Province</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Address</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Street</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Postal Code</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Registered</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($customers as $index => $customer)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $customer->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->phone ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->country ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->city ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->province ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->address ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->street ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->postal_code ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                @if ($customer->status === 'active')
                                    <span class="text-green-600 font-semibold">Active</span>
                                @elseif ($customer->status === 'inactive')
                                    <span class="text-red-600 font-semibold">Inactive</span>
                                @else
                                    <span class="text-gray-600 font-semibold">Unknown</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $customer->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No clients found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
