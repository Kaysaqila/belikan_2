<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-[400px]">
        <h2 class="text-lg font-semibold mb-4">Pilih Metode Pembayaran</h2>

        <ul class="space-y-2">
            @foreach ($paymentMethods as $key => $name)
                <li>
                    <button wire:click="selectMethod('{{ $key }}')"
                            class="w-full px-4 py-2 border rounded 
                            {{ $selectedMethod === $key ? 'bg-blue-500 text-white' : 'bg-gray-100 hover:bg-gray-200' }}">
                        {{ $name }}
                    </button>
                </li>
            @endforeach
        </ul>

        <div class="flex justify-between mt-6">
            <button wire:click="closeModal" class="text-gray-500">Nanti</button>

            <button wire:click="confirmSelection" class="bg-blue-600 text-white px-4 py-2 rounded">
                OK
            </button>
        </div>
    </div>
</div>
