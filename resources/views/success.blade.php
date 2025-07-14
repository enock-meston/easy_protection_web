<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Favicon (replace with your actual app icon) -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
</head>
<body>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Card Header with App Icon -->
            <div class="bg-indigo-600 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <!-- App Icon - Replace src with your actual app icon -->
                    <img src="{{ asset('images/logo.png') }}" alt="App Icon" class="w-10 h-10 rounded-lg">
                    <h1 class="text-2xl font-bold text-white">Payment Status</h1>
                </div>
                <div class="text-white text-sm">
                    <!-- Optional: Add app name or tagline -->
                    <span>Easy Protection</span>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6 space-y-6">
                <!-- Status Indicator -->
                <div class="flex flex-col items-center">
                    @if($status === 'successful')
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-check-circle text-green-600 text-5xl"></i>
                        </div>
                        <h2 class="text-xl font-semibold text-green-600">Payment Successful!</h2>
                        <p class="text-gray-500 mt-2 text-center">Thank you for your payment</p>
                    @else
                        <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-times-circle text-red-600 text-5xl"></i>
                        </div>
                        <h2 class="text-xl font-semibold text-red-600">Payment {{ ucfirst($status) }}</h2>
                        <p class="text-gray-500 mt-2 text-center">Please try again or contact support</p>
                    @endif
                </div>

                <!-- Action Button -->
                <div class="pt-4">
                    <a href="{{ route('client.home') }}" class="w-full block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                        <i class="fas fa-home mr-2"></i> Back to Home
                    </a>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="bg-gray-50 px-6 py-4 text-center border-t border-gray-200">
                <p class="text-sm text-gray-500">Need help? <a href="#" class="text-indigo-600 hover:underline">Contact support</a></p>
                <!-- App Logo Small -->
                <div class="mt-3 flex justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="App Logo" class="h-6 opacity-80">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
