<div class="bg-white min-h-screen">
    <!-- Tabel Keranjang -->
    <div class="px-6 mt-6">
        <div class="grid grid-cols-5 font-semibold bg-[#002060] text-white rounded-t p-3">
            <div class="col-span-2 pl-32">Produk</div>
            <div>Harga Satuan</div>
            <div>Kuantitas</div>
            <div>Total</div>
        </div>

        @forelse ($cart as $item)
            <div class="grid grid-cols-5 items-center border p-4 rounded-b mb-4" wire:key="row-{{ $item->id }}">
                <!-- Checkbox + Gambar + Nama -->
                <div class="flex items-center col-span-2 space-x-4">
                    <input type="checkbox" 
                            wire:model.live="selectedItems" 
                            value="{{ $item->id }}" 
                            class="checkbox-item" />
                    <img src="{{ asset('storage/' . $item->product->image) }}" wire:ignore alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded" />
                    <span class="font-medium text-gray-800">{{ $item->product->name }}</span>
                </div>

                <!-- Harga -->
                <div>
                    Rp{{ number_format($item->product->price, 0, ',', '.') }}
                </div>

                <!-- Kuantitas -->
                <div class="flex items-center space-x-2">
                    <button wire:click="decrementQuantity({{ $item->id }})" class="border px-2">-</button>
                    <span>{{ $item->quantity }}</span>
                    <button wire:click="incrementQuantity({{ $item->id }})" class="border px-2">+</button>
                </div>

                <!-- Total Harga per item -->
                <div>
                    Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 mt-6">Keranjang masih kosong.</p>
        @endforelse
    </div>

    <!-- Voucher dan Total -->
    <div class="bg-gray-200 mt-10 p-4">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-2 font-semibold">
                <span>Voucer BELIKAN</span>
            </div>
            <input type="text" placeholder="Masukkan Kode" class="border px-2 py-1 rounded" />
        </div>

        <div class="mt-4">
            <label class="block font-medium mb-1">Kode Voucher:</label>
            <div class="flex items-center space-x-2">
                <input type="text" wire:model="voucherCode" class="border px-2 py-1 rounded" placeholder="Masukkan kode voucher">
                <button wire:click="applyVoucher" class="bg-blue-600 text-white px-3 py-1 rounded">Gunakan</button>
            </div>
            @error('voucherCode') 
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4 text-right">
           <p>Total: Rp{{ number_format($total, 0, ',', '.') }}</p>
            @if ($voucherApplied)
                <p class="text-green-600">Diskon: -Rp{{ number_format($discount, 0, ',', '.') }}</p>
            @endif
        </div>

        <div class="flex justify-between items-center border-t pt-4">
            <label class="flex items-center space-x-2">
                <input type="checkbox" wire:model.live="selectAll" class="w-4 h-4" />
                <span>Pilih Semua</span>
            </label>
            <div class="flex items-center space-x-4">
                <span class="font-semibold">Total Bayar: Rp{{ number_format($totalAfterDiscount, 0, ',', '.') }}</span>
                <button wire:click="startCheckout"
                        class="bg-[#002060] text-white px-4 py-2 rounded hover:bg-[#001540]">
                    Check Out
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
