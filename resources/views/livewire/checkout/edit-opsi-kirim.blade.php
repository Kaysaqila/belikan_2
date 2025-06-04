<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-[400px]">
        <div class="p-4">
            <h2 class="font-bold mb-2">Opsi Pengiriman</h2>

            <div class="grid grid-cols-2 gap-2 mb-4">
                <button class="border p-2 rounded">Antar Ke Alamatmu<br><span class="text-blue-500 text-sm">Mulai dari Rp10.000</span></button>
                <button class="border p-2 rounded">Antar Ke Alamatmu<br><span class="text-blue-500 text-sm">Mulai dari Rp10.000</span></button>
            </div>

            <div>
                <h3 class="font-semibold mb-2">PILIH JASA PENGIRIMAN</h3>

                @foreach ($shippingOptions as $key => $option)
                    <div wire:click="selectOption('{{ $key }}')" class="cursor-pointer border rounded p-3 mb-2 {{ $selectedOption === $key ? 'bg-blue-100' : '' }}">
                        <div class="font-bold">{{ $option['label'] }} Rp {{ number_format($option['price'], 0, ',', '.') }}</div>
                        <div class="text-sm text-gray-500">Garansi Tiba: {{ $option['guarantee'] }}</div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 flex justify-end gap-2">
                <button wire:click="$dispatch('closeOpsiKirim')" class="px-4 py-2 bg-gray-200 rounded">Nanti</button>
                <button wire:click="confirmSelection" class="px-4 py-2 bg-blue-500 text-white rounded">OKE</button>
            </div>
        </div>
    </div>
</div>