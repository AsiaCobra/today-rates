<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Today Rates - @yield('title')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('styles')
</head>

<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="{{ route('home') }}" class="flex items-center py-4">
                            <span class="font-semibold text-gray-500 text-lg">Today Rates</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{ route('home') }}" class="py-4 px-2 text-gray-500 hover:text-green-500 transition duration-300">Home</a>
                        <a href="{{ route('terms') }}" class="py-4 px-2 text-gray-500 hover:text-green-500 transition duration-300">Terms & Conditions</a>
                        <a href="{{ route('privacy') }}" class="py-4 px-2 text-gray-500 hover:text-green-500 transition duration-300">Privacy Policy</a>
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
            <div class="flex justify-between items-center">
                <div class="text-gray-500">
                    &copy; {{ date('Y') }} Today Rates. All rights reserved.
                </div>
                <div class="text-gray-500" id="current-time">
                    {{ now()->format('F j, Y H:i:s') }}
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript for updating time -->
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
    @yield('scripts')
</body>

</html>