<x-filament-panels::page>
    <div class="flex flex-col items-center justify-center space-y-4">
        <x-filament::button wire:click="analize">
            Analyze Products
        </x-filament::button>

        <!-- Menampilkan hasil analisis jika sudah dianalisis -->
        @if($isAnalized)
            <div class="w-full max-w-3xl p-6 bg-white shadow-md rounded-lg">
                <h2 class="text-base font-semibold mb-4">Analysis Result</h2>

                <!-- Data Analisis -->
                <div class="grid grid-cols-2 gap-1 text-gray-700 text-sm mb-5">
                    <div><span class="font-semibold">Available Products:</span> {{ $availableProduct }}</div>
                    <div><span class="font-semibold">Unavailable Products:</span> {{ $unavailableProduct }}</div>
                    <div><span class="font-semibold">Top Selling Product:</span> {{ $topSelling }}</div>
                    <div><span class="font-semibold">Total Products:</span> {{ $totalProduct }}</div>
                    <div class="col-span-2"><span class="font-semibold">Total Price:</span> Rp {{ number_format($totalPrice, 0, ',', '.') }}</div>
                </div>

                <!-- Rekomendasi -->
                <div class="mt-4 text-sm">
                    <h3 class="font-semibold mb-2">Recommendations</h3>
                    
                    @if(count($recomendation) > 0)
                        <ul class="list-disc list-inside text-gray-700">
                            @foreach($recomendation as $item)
                                <li class="mb-0">{{ $item }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">No recommendations available. Everything looks good!</p>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>
