<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Courier Urid')</title>
    @vite('resources/css/app.css') {{-- Laravel Vite with Tailwind --}}
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-blue-600">
              <a href="/">  🚚 Courier SaaS </a>
            </div>
            <div class="flex space-x-4">
                @auth
                <a href="{{ route('filament.user.pages.dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                @else
                <a href="{{ route('filament.user.auth.login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                <a href="{{ route('filament.user.auth.register') }}" class="text-gray-700 hover:text-blue-600">Create Account</a>
                @endauth
                
                <a href="{{ route('track.form') }}" class="text-gray-700 hover:text-blue-600">Track Shipment</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-4 py-10">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 py-4 text-center text-sm text-gray-600">
        &copy; {{ date('Y') }} Courier Urid. All rights reserved.
    </footer>
</body>
</html>
