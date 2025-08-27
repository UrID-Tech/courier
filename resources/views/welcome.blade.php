{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Courier Urid - Welcome</title>
    @vite('resources/css/app.css') {{-- Laravel Vite with Tailwind --}}
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-blue-600">🚚 Courier SaaS</div>
            <div class="flex space-x-4">
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">Create Account</a>
                <a href="{{ route('track.form') }}" class="text-gray-700 hover:text-blue-600">Track Shipment</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-center mb-8">📦 Get a Shipping Quote</h1>

        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md p-6">
            <form action="{{ route('quote.calculate') }}" method="POST" class="space-y-4">
                @csrf

                <!-- From Location -->
                <div>
                    <label class="block mb-1 font-medium">From Location</label>
                    <select name="from_location_id" class="w-full rounded-lg border-gray-300">
                        @foreach($locations as $loc)
                            <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- To Location -->
                <div>
                    <label class="block mb-1 font-medium">To Location</label>
                    <select name="to_location_id" class="w-full rounded-lg border-gray-300">
                        @foreach($locations as $loc)
                            <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Category -->
                <div>
                    <label class="block mb-1 font-medium">Shipment Category</label>
                    <select name="category_id" class="w-full rounded-lg border-gray-300">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Dimensions -->
                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label class="block mb-1 font-medium">Length (cm)</label>
                        <input type="number" name="length" step="0.01" class="w-full rounded-lg border-gray-300">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium">Width (cm)</label>
                        <input type="number" name="width" step="0.01" class="w-full rounded-lg border-gray-300">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium">Height (cm)</label>
                        <input type="number" name="height" step="0.01" class="w-full rounded-lg border-gray-300">
                    </div>
                </div>

                <!-- Weight -->
                <div>
                    <label class="block mb-1 font-medium">Weight (kg)</label>
                    <input type="number" name="weight" step="0.01" class="w-full rounded-lg border-gray-300">
                </div>

                <!-- Submit -->
                <div class="text-center">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Get Estimate
                    </button>
                </div>
            </form>

            @isset($price)
                <div class="mt-6 text-center">
                    <h2 class="text-xl font-semibold text-green-600">Estimated Price: {{ number_format($price, 2) }} {{ config('app.currency', 'USD') }}</h2>
                </div>
            @endisset
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 py-4 text-center text-sm text-gray-600">
        &copy; {{ date('Y') }} Courier Urid. All rights reserved.
    </footer>
</body>
</html>
