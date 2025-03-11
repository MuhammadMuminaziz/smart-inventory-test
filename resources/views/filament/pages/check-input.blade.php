<x-filament-panels::page>
    <div class="w-1/2 mx-auto mt-10 space-y-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Input 1</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model.defer="inputOne"
                />
            </x-filament::input.wrapper>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Input 2</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model.defer="inputTwo"
                />
            </x-filament::input.wrapper>
        </div>

        <x-filament::button wire:click="checkMatch">
            Check Match
        </x-filament::button>

        @if ($isChecked)
            <div class="text-sm p-6 bg-white shadow-md rounded-lg">
                <div class="">
                Total chars input 1: {{ $totalChars }}
                </div>
                <div class="">
                    Total matches: {{ $totalMatches }}
                </div>
                <div class="font-semibold">
                    Match Percentage: {{ $matchPercentage }}%
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>
