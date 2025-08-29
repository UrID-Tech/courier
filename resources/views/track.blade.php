@extends('layouts.app')

@section('title', 'Track Shipment')

@section('content')
    <div class="w-full max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center mb-4">Track Your Shipment</h1>

        @if(session('error'))
            <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('track.search') }}" method="POST" class="flex gap-2 mb-6">
            @csrf
            <input type="text" name="tracking_number"
                   placeholder="Enter Tracking Number"
                   value="{{ old('tracking_number') }}"
                   class="flex-1 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Track
            </button>
        </form>

        @if(session('order'))
        @php
            $order = session('order');
        @endphp
            <div class="border-t pt-4">
                <h2 class="text-xl font-semibold mb-2">Shipment Details</h2>
                <p><span class="font-medium">Tracking Number:</span> {{ $order->tracking_number }}</p>
                <p><span class="font-medium">Status:</span> {{ ucfirst($order->status->value) }}</p>
                <p><span class="font-medium">From:</span> {{ $order->origin->name ?? '-' }}</p>
                <p><span class="font-medium">To:</span> {{ $order->destination->name ?? '-' }}</p>
                <p><span class="font-medium">Category:</span> {{ $order->category->name ?? '-' }}</p>
                <p><span class="font-medium">Price:</span> ${{ number_format($order->price, 2) }}</p>
            </div>
        @endif
    </div>
@endsection
