<div class="bg-white p-6 rounded shadow-md w-full max-w-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Masukkan Kode Voucher</h2>
        <button wire:click="$dispatch('closeVoucher')" class="text-gray-600 hover:text-gray-900 text-xl">&times;</button>
    </div>

    <div>
        <input type="text" wire:model="voucherCode" placeholder="Contoh: HEMAT10" class="w-full border px-3 py-2 rounded mb-2">
        <button wire:click="applyVoucher" class="bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700">Gunakan</button>

        @error('voucherCode')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
</div>
