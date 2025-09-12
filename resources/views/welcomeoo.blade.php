@extends('layouts.app')

@section('title', 'Courier Urid - Welcome')

@section('content')
    <h1 class="text-3xl font-bold text-center mb-8">📦 Get a Shipping Quote</h1>

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md p-6">

        {{-- Error Summary --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <strong>Whoops! Something went wrong.</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('quote.calculate') }}" method="POST" class="space-y-4">
            @csrf

            <!-- From Location -->
            <div>
                <label class="block mb-1 font-medium">From Location</label>
                <select name="from_location_id"
                    class="w-full rounded-lg border-gray-300 @error('from_location_id') border-red-500 @enderror">
                    @foreach($locations as $loc)
                        <option value="{{ $loc->id }}" 
                            {{ old('from_location_id') == $loc->id ? 'selected' : '' }}>
                            {{ $loc->name }}
                        </option>
                    @endforeach
                </select>
                @error('from_location_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- To Location -->
            <div>
                <label class="block mb-1 font-medium">To Location</label>
                <select name="to_location_id"
                    class="w-full rounded-lg border-gray-300 @error('to_location_id') border-red-500 @enderror">
                    @foreach($locations as $loc)
                        <option value="{{ $loc->id }}" 
                            {{ old('to_location_id') == $loc->id ? 'selected' : '' }}>
                            {{ $loc->name }}
                        </option>
                    @endforeach
                </select>
                @error('to_location_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block mb-1 font-medium">Shipment Category</label>
                <select name="category_id"
                    class="w-full rounded-lg border-gray-300 @error('category_id') border-red-500 @enderror">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" 
                            {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Dimensions -->
            <div class="grid grid-cols-3 gap-2">
                <div>
                    <label class="block mb-1 font-medium">Length (cm)</label>
                    <input type="number" name="length" step="0.01"
                        class="w-full rounded-lg border-gray-300 @error('length') border-red-500 @enderror"
                        value="{{ old('length') }}">
                    @error('length')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1 font-medium">Width (cm)</label>
                    <input type="number" name="width" step="0.01"
                        class="w-full rounded-lg border-gray-300 @error('width') border-red-500 @enderror"
                        value="{{ old('width') }}">
                    @error('width')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1 font-medium">Height (cm)</label>
                    <input type="number" name="height" step="0.01"
                        class="w-full rounded-lg border-gray-300 @error('height') border-red-500 @enderror"
                        value="{{ old('height') }}">
                    @error('height')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Weight -->
            <div>
                <label class="block mb-1 font-medium">Weight (kg)</label>
                <input type="number" name="weight" step="0.01"
                    class="w-full rounded-lg border-gray-300 @error('weight') border-red-500 @enderror"
                    value="{{ old('weight') }}">
                @error('weight')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
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
