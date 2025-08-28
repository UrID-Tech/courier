@extends('layouts.app')

@section('title', 'Courier Urid - Welcome')

@section('content')
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

        @if(session('quote'))
            <div class="mt-6 text-center">
                <h2 class="text-xl font-semibold text-green-600">
                    Estimated Price: {{ number_format(session('quote'), 2) }} {{ config('app.currency', 'RWF') }}
                </h2>
            </div>
        @endif
    </div>
@endsection
