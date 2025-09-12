<x-filament-panels::page>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            
            <div class="space-x-2">
                <a href="{{ route('shipping.label.bulk-pdf', ['ids' => request('ids')]) }}"
                   target="_blank"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Download PDF
                </a>
                <button onclick="window.print()"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Print
                </button>
            </div>
        </div>

        
            <div class="border border-gray-300 rounded-lg p-6 bg-white shadow-md print:shadow-none print:border-none mb-8">
                <h2 class="text-lg font-semibold mb-2">Order #{{ $order->id }}</h2>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><strong>Tracking #:</strong> {{ $order->tracking_number }}</p>
                        <p><strong>Category:</strong> {{ $order->category->name }}</p>
                        <p><strong>From:</strong> {{ $order->origin->name }}</p>
                        <p><strong>To:</strong> {{ $order->destination->name }}</p>
                        <p><strong>Sender:</strong> {{ $order->customer->name ?? '-' }}</p>
                        <p><strong>Receiver:</strong> {{ $order->receiver_name }} ({{ $order->receiver_phone }})</p>
                        <p><strong>Weight:</strong> {{ $order->weight }} kg</p>
                        <p><strong>Dimensions:</strong> {{ $order->length }} x {{ $order->width }} x {{ $order->height }} cm</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($order->tracking_number, 'C39') }}" alt="barcode"/>
                        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($order->tracking_number, 'QRCODE') }}" alt="qrcode" class="mt-2"/>
                    </div>
                </div>

                <p class="mt-2"><strong>Weight:</strong> {{ $order->weight }} kg</p>
                <p><strong>Dimensions:</strong> {{ $order->length }} x {{ $order->width }} x {{ $order->height }} cm</p>
                <p><strong>Price:</strong> {{ number_format($order->price, 2) }} {{ config('app.currency', 'USD') }}</p>
            </div>
       
    </div>
</x-filament-panels::page>

