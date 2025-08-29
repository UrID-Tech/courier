<x-filament::widget>
    <x-filament::card>
        <h5>Quick Order Track</h5><br/>
        <form wire:submit.prevent="submit" class="space-y-4">
            <x-filament::input.wrapper>
                <x-filament::input
                    wire:model.defer="trackingNumber"
                    type="text"
                    placeholder="Enter tracking number"
                />
            </x-filament::input.wrapper><br />

            <x-filament::button type="submit" color="primary">
                Search
            </x-filament::button>
        </form>

        @if ($result)
            <div class="mt-6 space-y-2">
                <p><strong>Tracking #:</strong> {{ $result['tracking_number'] }}</p>
                <p><strong>Status:</strong> {{ $result['status'] }}</p>
                <p><strong>Customer:</strong> {{ $result['customer'] }}</p>
                <p><strong>Origin:</strong> {{ $result['origin'] }}</p>
                <p><strong>Destination:</strong> {{ $result['destination'] }}</p>
                <p><strong>Latest Event:</strong> {{ $result['latest_event'] }}</p>
            </div>
        @endif
    </x-filament::card>
</x-filament::widget>
<x-filament::widget>
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-4">
            <x-filament::input.wrapper>
                <x-filament::input
                    wire:model.defer="trackingNumber"
                    type="text"
                    placeholder="Enter tracking number"
                />
            </x-filament::input.wrapper>

            <x-filament::button type="submit" color="primary">
                Search
            </x-filament::button>
        </form>

        @if ($result)
            <div class="mt-6 space-y-2">
                <p><strong>Tracking #:</strong> {{ $result['tracking_number'] }}</p>
                <p><strong>Status:</strong> {{ $result['status'] }}</p>
                <p><strong>Customer:</strong> {{ $result['customer'] }}</p>
                <p><strong>Origin:</strong> {{ $result['origin'] }}</p>
                <p><strong>Destination:</strong> {{ $result['destination'] }}</p>
                <p><strong>Latest Event:</strong> {{ $result['latest_event'] }}</p>
            </div>
        @endif
    </x-filament::card>
</x-filament::widget>
<x-filament::widget>
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-4">
            <x-filament::input.wrapper>
                <x-filament::input
                    wire:model.defer="trackingNumber"
                    type="text"
                    placeholder="Enter tracking number"
                />
            </x-filament::input.wrapper>

            <x-filament::button type="submit" color="primary">
                Search
            </x-filament::button>
        </form>

        @if ($result)
            <div class="mt-6 space-y-2">
                <p><strong>Tracking #:</strong> {{ $result['tracking_number'] }}</p>
                <p><strong>Status:</strong> {{ $result['status'] }}</p>
                <p><strong>Customer:</strong> {{ $result['customer'] }}</p>
                <p><strong>Origin:</strong> {{ $result['origin'] }}</p>
                <p><strong>Destination:</strong> {{ $result['destination'] }}</p>
                <p><strong>Latest Event:</strong> {{ $result['latest_event'] }}</p>
            </div>
        @endif
    </x-filament::card>
</x-filament::widget>
<x-filament::widget>
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-4">
            <x-filament::input.wrapper>
                <x-filament::input
                    wire:model.defer="trackingNumber"
                    type="text"
                    placeholder="Enter tracking number"
                />
            </x-filament::input.wrapper>

            <x-filament::button type="submit" color="primary">
                Search
            </x-filament::button>
        </form>

        @if ($result)
            <div class="mt-6 space-y-2">
                <p><strong>Tracking #:</strong> {{ $result['tracking_number'] }}</p>
                <p><strong>Status:</strong> {{ $result['status'] }}</p>
                <p><strong>Customer:</strong> {{ $result['customer'] }}</p>
                <p><strong>Origin:</strong> {{ $result['origin'] }}</p>
                <p><strong>Destination:</strong> {{ $result['destination'] }}</p>
                <p><strong>Latest Event:</strong> {{ $result['latest_event'] }}</p>
            </div>
        @endif
    </x-filament::card>
</x-filament::widget>
<x-filament::widget>
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-4">
            <x-filament::input.wrapper>
                <x-filament::input
                    wire:model.defer="trackingNumber"
                    type="text"
                    placeholder="Enter tracking number"
                />
            </x-filament::input.wrapper>

            <x-filament::button type="submit" color="primary">
                Search
            </x-filament::button>
        </form>

        @if ($result)
            <div class="mt-6 space-y-2">
                <p><strong>Tracking #:</strong> {{ $result['tracking_number'] }}</p>
                <p><strong>Status:</strong> {{ $result['status'] }}</p>
                <p><strong>Customer:</strong> {{ $result['customer'] }}</p>
                <p><strong>Origin:</strong> {{ $result['origin'] }}</p>
                <p><strong>Destination:</strong> {{ $result['destination'] }}</p>
                <p><strong>Latest Event:</strong> {{ $result['latest_event'] }}</p>
            </div>
        @endif
    </x-filament::card>
</x-filament::widget>
<x-filament::widget>
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-4">
            <x-filament::input.wrapper>
                <x-filament::input
                    wire:model.defer="trackingNumber"
                    type="text"
                    placeholder="Enter tracking number"
                />
            </x-filament::input.wrapper>

            <x-filament::button type="submit" color="primary">
                Search
            </x-filament::button>
        </form>

        @if ($result)
            <div class="mt-6 space-y-2">
                <p><strong>Tracking #:</strong> {{ $result['tracking_number'] }}</p>
                <p><strong>Status:</strong> {{ $result['status'] }}</p>
                <p><strong>Customer:</strong> {{ $result['customer'] }}</p>
                <p><strong>Origin:</strong> {{ $result['origin'] }}</p>
                <p><strong>Destination:</strong> {{ $result['destination'] }}</p>
                <p><strong>Latest Event:</strong> {{ $result['latest_event'] }}</p>
            </div>
        @endif
    </x-filament::card>
</x-filament::widget>
<x-filament::widget>
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-4">
            <x-filament::input.wrapper>
                <x-filament::input
                    wire:model.defer="trackingNumber"
                    type="text"
                    placeholder="Enter tracking number"
                />
            </x-filament::input.wrapper>

            <x-filament::button type="submit" color="primary">
                Search
            </x-filament::button>
        </form>

        @if ($result)
            <div class="mt-6 space-y-2">
                <p><strong>Tracking #:</strong> {{ $result['tracking_number'] }}</p>
                <p><strong>Status:</strong> {{ $result['status'] }}</p>
                <p><strong>Customer:</strong> {{ $result['customer'] }}</p>
                <p><strong>Origin:</strong> {{ $result['origin'] }}</p>
                <p><strong>Destination:</strong> {{ $result['destination'] }}</p>
                <p><strong>Latest Event:</strong> {{ $result['latest_event'] }}</p>
            </div>
        @endif
    </x-filament::card>
</x-filament::widget>
<x-filament::widget>
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-4">
            <x-filament::input.wrapper>
                <x-filament::input
                    wire:model.defer="trackingNumber"
                    type="text"
                    placeholder="Enter tracking number"
                />
            </x-filament::input.wrapper>

            <x-filament::button type="submit" color="primary">
                Search
            </x-filament::button>
        </form>

        @if ($result)
            <div class="mt-6 space-y-2">
                <p><strong>Tracking #:</strong> {{ $result['tracking_number'] }}</p>
                <p><strong>Status:</strong> {{ $result['status'] }}</p>
                <p><strong>Customer:</strong> {{ $result['customer'] }}</p>
                <p><strong>Origin:</strong> {{ $result['origin'] }}</p>
                <p><strong>Destination:</strong> {{ $result['destination'] }}</p>
                <p><strong>Latest Event:</strong> {{ $result['latest_event'] }}</p>
            </div>
        @endif
    </x-filament::card>
</x-filament::widget>
<x-filament::widget>
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-4">
            <x-filament::input.wrapper>
                <x-filament::input
                    wire:model.defer="trackingNumber"
                    type="text"
                    placeholder="Enter tracking number"
                />
            </x-filament::input.wrapper>

            <x-filament::button type="submit" color="primary">
                Search
            </x-filament::button>
        </form>

        @if ($result)
            <div class="mt-6 space-y-2">
                <p><strong>Tracking #:</strong> {{ $result['tracking_number'] }}</p>
                <p><strong>Status:</strong> {{ $result['status'] }}</p>
                <p><strong>Customer:</strong> {{ $result['customer'] }}</p>
                <p><strong>Origin:</strong> {{ $result['origin'] }}</p>
                <p><strong>Destination:</strong> {{ $result['destination'] }}</p>
                <p><strong>Latest Event:</strong> {{ $result['latest_event'] }}</p>
            </div>
        @endif
    </x-filament::card>
</x-filament::widget>
<x-filament::widget>
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-4">
            <x-filament::input.wrapper>
                <x-filament::input
                    wire:model.defer="trackingNumber"
                    type="text"
                    placeholder="Enter tracking number"
                />
            </x-filament::input.wrapper>

            <x-filament::button type="submit" color="primary">
                Search
            </x-filament::button>
        </form>

        @if ($result)
            <div class="mt-6 space-y-2">
                <p><strong>Tracking #:</strong> {{ $result['tracking_number'] }}</p>
                <p><strong>Status:</strong> {{ $result['status'] }}</p>
                <p><strong>Customer:</strong> {{ $result['customer'] }}</p>
                <p><strong>Origin:</strong> {{ $result['origin'] }}</p>
                <p><strong>Destination:</strong> {{ $result['destination'] }}</p>
                <p><strong>Latest Event:</strong> {{ $result['latest_event'] }}</p>
            </div>
        @endif
    </x-filament::card>
</x-filament::widget>
<x-filament::widget>
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-4">
            <x-filament::input.wrapper>
                <x-filament::input
                    wire:model.defer="trackingNumber"
                    type="text"
                    placeholder="Enter tracking number"
                />
            </x-filament::input.wrapper>

            <x-filament::button type="submit" color="primary">
                Search
            </x-filament::button>
        </form>

        @if ($result)
            <div class="mt-6 space-y-2">
                <p><strong>Tracking #:</strong> {{ $result['tracking_number'] }}</p>
                <p><strong>Status:</strong> {{ $result['status'] }}</p>
                <p><strong>Customer:</strong> {{ $result['customer'] }}</p>
                <p><strong>Origin:</strong> {{ $result['origin'] }}</p>
                <p><strong>Destination:</strong> {{ $result['destination'] }}</p>
                <p><strong>Latest Event:</strong> {{ $result['latest_event'] }}</p>
            </div>
        @endif
    </x-filament::card>
</x-filament::widget>

