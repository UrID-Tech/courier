<x-filament-panels::page>
    {{ $this->form }}

    <div class="mt-4">
        <x-filament::button wire:click="save" color="primary">
            Save Settings
        </x-filament::button>
    </div>
</x-filament-panels::page>
