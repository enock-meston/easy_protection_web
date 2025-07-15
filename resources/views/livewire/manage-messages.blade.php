<div class="max-w-7xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Manage Messages</h2>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 flex flex-col items-center">
            <span class="text-sm text-gray-600">Total</span>
            <span class="text-2xl font-bold text-gray-900">{{ $totalMessages }}</span>
        </div>
        <div class="bg-yellow-50 rounded-xl p-6 shadow-sm border border-yellow-200 flex flex-col items-center">
            <span class="text-sm text-yellow-700">Pending</span>
            <span class="text-2xl font-bold text-yellow-900">{{ $pendingMessages->count() }}</span>
        </div>
        <div class="bg-blue-50 rounded-xl p-6 shadow-sm border border-blue-200 flex flex-col items-center">
            <span class="text-sm text-blue-700">Read</span>
            <span class="text-2xl font-bold text-blue-900">{{ $readMessages->count() }}</span>
        </div>
        <div class="bg-green-50 rounded-xl p-6 shadow-sm border border-green-200 flex flex-col items-center">
            <span class="text-sm text-green-700">Replied</span>
            <span class="text-2xl font-bold text-green-900">{{ $repliedMessages->count() }}</span>
        </div>
        <div class="bg-purple-50 rounded-xl p-6 shadow-sm border border-purple-200 flex flex-col items-center">
            <span class="text-sm text-purple-700">Solved</span>
            <span class="text-2xl font-bold text-purple-900">{{ $solvedMessages->count() }}</span>
        </div>
    </div>

    <!-- Messages Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-x-auto">
        <table class="w-full min-w-max">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sender</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Received</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($messages as $index => $msg)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-900">{{ $msg->first_name }} {{ $msg->last_name }}</div>
                            <div class="text-xs text-gray-500">{{ $msg->email }}<br>{{ $msg->phone }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $msg->subject }}</td>
                        <td class="px-4 py-4 whitespace-nowrap max-w-xs text-sm text-gray-700 truncate">{{ Str::limit($msg->message, 40) }}</td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'read' => 'bg-blue-100 text-blue-800',
                                    'replied' => 'bg-green-100 text-green-800',
                                    'solved' => 'bg-purple-100 text-purple-800',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$msg->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($msg->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-500">{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="view({{ $msg->id }})" class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-600 bg-blue-50 rounded-md hover:bg-blue-100 transition-colors duration-150">
                                <i class="fas fa-eye mr-1"></i> View
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">No messages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Message Modal (Livewire) -->
    @if($selectedMessage)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-xl shadow-xl max-w-lg w-full p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Message Details</h3>
                    <button wire:click="$set('selectedMessage', null)" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div>
                    <div class="mb-2"><span class="font-semibold">From:</span> {{ $selectedMessage->first_name }} {{ $selectedMessage->last_name }}</div>
                    <div class="mb-2"><span class="font-semibold">Email:</span> {{ $selectedMessage->email }}</div>
                    <div class="mb-2"><span class="font-semibold">Phone:</span> {{ $selectedMessage->phone }}</div>
                    <div class="mb-2"><span class="font-semibold">Subject:</span> {{ $selectedMessage->subject }}</div>
                    <div class="mb-2 flex items-center gap-2">
                        <span class="font-semibold">Status:</span>
                        @foreach(['pending', 'read', 'replied', 'solved'] as $status)
                            <button wire:click="updateStatus({{ $selectedMessage->id }}, '{{ $status }}')"
                                class="px-2 py-1 rounded text-xs font-semibold focus:outline-none transition
                                    {{ $selectedMessage->status === $status ? (
                                        $status === 'pending' ? 'bg-yellow-500 text-white' :
                                        ($status === 'read' ? 'bg-blue-500 text-white' :
                                        ($status === 'replied' ? 'bg-green-500 text-white' :
                                        ($status === 'solved' ? 'bg-purple-500 text-white' : 'bg-gray-200 text-gray-700')))) :
                                        'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                {{ ucfirst($status) }}
                            </button>
                        @endforeach
                    </div>
                    <div class="mb-2"><span class="font-semibold">Received:</span> {{ $selectedMessage->created_at->format('Y-m-d H:i') }}</div>
                    <div class="mb-4"><span class="font-semibold">Message:</span>
                        <div class="mt-1 p-2 bg-gray-50 rounded text-gray-700">{{ $selectedMessage->message }}</div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
