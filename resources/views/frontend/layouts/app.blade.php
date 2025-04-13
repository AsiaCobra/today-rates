<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today Rates - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="{{ route('frontend.home') }}" class="flex items-center py-4">
                            <span class="font-semibold text-gray-500 text-lg">Today Rates</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{ route('frontend.home') }}" 
                           class="py-4 px-2 {{ request()->routeIs('frontend.home') ? 'text-green-500 border-b-2 border-green-500' : 'text-gray-500 hover:text-green-500' }} transition duration-300">
                            Home
                        </a>
                        <a href="{{ route('frontend.terms') }}"
                           class="py-4 px-2 {{ request()->routeIs('frontend.terms') ? 'text-green-500 border-b-2 border-green-500' : 'text-gray-500 hover:text-green-500' }} transition duration-300">
                            Terms & Conditions
                        </a>
                        <a href="{{ route('frontend.privacy') }}"
                           class="py-4 px-2 {{ request()->routeIs('frontend.privacy') ? 'text-green-500 border-b-2 border-green-500' : 'text-gray-500 hover:text-green-500' }} transition duration-300">
                            Privacy Policy
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-lg mt-auto">
        <div class="max-w-6xl mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-500 mb-2 md:mb-0">
                    &copy; {{ date('Y') }} Today Rates. All rights reserved.
                </div>
                <div class="text-gray-500" id="current-time">
                    {{ now()->format('F j, Y H:i:s') }}
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        function updateTime() {
            const timeElement = document.getElementById('current-time');
            const options = { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            timeElement.textContent = new Date().toLocaleString('en-US', options);
        }

        setInterval(updateTime, 1000);
    </script>
    @stack('scripts')
</body>
</html> 