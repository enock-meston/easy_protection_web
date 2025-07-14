<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyProtection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.1/classic/ckeditor.js"></script>

    <!-- EasyMDE CSS -->
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">

    <!-- Alpine.js (if not already included) -->
    <script src="https://unpkg.com/alpinejs" defer></script>

    <!-- EasyMDE JS -->
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .sidebar-item {
            transition: all 0.2s ease;
        }

        .sidebar-item:hover {
            background: linear-gradient(90deg, #667eea20, #764ba220);
            border-left: 4px solid #667eea;
        }

        .sidebar-item.active {
            background: linear-gradient(90deg, #667eea30, #764ba230);
            border-left: 4px solid #667eea;
            color: #667eea;
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-shipped {
            background: #10b98120;
            color: #059669;
        }

        .status-pending {
            background: #f59e0b20;
            color: #d97706;
        }

        .status-canceled {
            background: #ef444420;
            color: #dc2626;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen">
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-btn" class="md:hidden fixed top-4 left-4 z-50 p-2 bg-white rounded-lg shadow-lg">
        <i class="fas fa-bars text-gray-600"></i>
    </button>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('layouts.includes.admin.sidebar')

        <!-- Main Content -->
        <main class="flex-1 md:ml-0">
            <!-- Top Navigation -->
            @include('layouts.includes.admin.header')

            {{-- update about page --}}
            <div class="container mx-auto px-4">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Update About Page</h2>
                </div>
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-6">
                    <form action="{{ url('/dashboard/about-page') }}" method="post" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-xl shadow-md max-w-2xl">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" name="title" value="{{ old('title', $aboutPage->title ?? '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('title')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $aboutPage->description ?? '') }}</textarea>
                            @error('description')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mission</label>
                            <textarea name="mission" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('mission', $aboutPage->mission ?? '') }}</textarea>
                            @error('mission')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Vision</label>
                            <textarea name="vision" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('vision', $aboutPage->vision ?? '') }}</textarea>
                            @error('vision')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                            <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                            @if (!empty($aboutPage->image))
                                <div class="mt-2">
                                    <img src="{{ asset('about_images/' . $aboutPage->image) }}" alt="About Image" class="h-32 rounded-lg border border-gray-200">
                                </div>
                            @endif
                            @error('image')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            @include('layouts.includes.admin.footer')

    </div>
    </main>
    </div>

    <!-- Mobile menu overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden"></div>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobile-overlay');

        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            mobileOverlay.classList.toggle('hidden');
        });

        mobileOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            mobileOverlay.classList.add('hidden');
        });

        // Sidebar navigation
        const sidebarItems = document.querySelectorAll('.sidebar-item');
        sidebarItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                sidebarItems.forEach(i => i.classList.remove('active'));
                item.classList.add('active');
            });
        });

        // Update current time
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', {
                hour12: false,
                hour: '2-digit',
                minute: '2-digit'
            });
            document.getElementById('current-time').textContent = timeString;
        }

        // Update time every second
        updateTime();
        setInterval(updateTime, 1000);
    </script>
</body>

</html>
