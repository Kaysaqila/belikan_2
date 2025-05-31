<div class="min-h-screen bg-[#071e3d] p-6">
    <div class="bg-[#e3e9f7] text-black rounded-lg p-4 mb-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-lg font-bold text-blue-900">📍 Alamat Pengiriman</p>
                    <p>{{ $shippingName ?? 'Alamat belum tersedia' }}</p>
                </div>
                <div>
                    <p class="text-lg font-bold text-blue-900">📍 Alamat Pengiriman</p>
                    <p>{{ $shippingAddress ?? 'Alamat belum tersedia' }}</p>
                </div>
                <div>
                    <p class="text-lg font-bold text-blue-900">📍 Alamat Pengiriman</p>
                    <p>{{ $shippingNumber ?? 'Alamat belum tersedia' }}</p>
                </div>
                <div>
                    <button wire:click="openEditAddressModal" class="ml-2 bg-blue-500 px-3 py-2 rounded text-white">Ubah</button>
                    @php
                        $showEditAddress = $showEditAddress ?? false;
                    @endphp
                   @if ($showEditAddress)
                        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                            @livewire('checkout.edit-alamat-penerima')
                    @endif
                </div>
            </div>
        </div>

         <div class="bg-[#e3e9f7] text-black rounded-lg p-4 mb-6">
            @if ($selectedProducts && count($selectedProducts) > 0)
                    <div class="px-6 mt-6">
                        <h2 class="text-lg font-bold text-blue-900 mb-2">Produk Pesanan</h2>

                        <!-- Header -->
                        <div class="grid grid-cols-4 font-semibold bg-[#002060] text-white rounded-t p-3">
                            <div class="pl-4">Produk</div>
                            <div>Harga Satuan</div>
                            <div>Jumlah</div>
                            <div>Subtotal</div>
                        </div>

                        <!-- Data Produk -->
                        @foreach ($selectedProducts as $item)
                            <div class="grid grid-cols-4 items-center border p-4 rounded-b mb-4" wire:key="selected-{{ $item->id }}">
                                <!-- Produk (gambar + nama) -->
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $item->product->image) }}" wire:ignore alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded" />
                                    <span class="text-gray-800 font-medium">{{ $item->product->name }}</span>
                                </div>

                                <!-- Harga Satuan -->
                                <div>
                                    Rp{{ number_format($item->product->price, 0, ',', '.') }}
                                </div>

                                <!-- Jumlah -->
                                <div>
                                    {{ $item->quantity }}
                                </div>

                                <!-- Subtotal Produk -->
                                <div>
                                    Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
            @endif
        </div>

         <div class="mb-4">
            <label class="block font-bold mb-1">🎁 Voucher BELIKAN</label>
            <button wire:click="openVoucher" class="ml-2 bg-blue-500 px-3 py-2 rounded text-white">Masukkan Kode</button>

            @if ($showVoucher)
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    @livewire('checkout.voucher', [], key('voucher-modal'))
                </div>
            @endif
        </div>
        @if ($voucherAppliedInCart)
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Voucher sudah digunakan di halaman cart.</strong>
                <span class="block sm:inline">Kamu tidak bisa menggunakannya lagi di checkout.</span>
            </div>
        @endif

        <!-- Catatan dan Pengiriman -->
        <div class="flex gap-2 mb-4">
            <input type="text" wire:model="note" placeholder="Pesan : Tinggalkan Pesan (opsional)" class="flex-1 p-2 border rounded">
            <div class="text-sm"></div>
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-4 text-white">
            <label class="block font-bold mb-1 text-white">Metode Pembayaran</label>
                <div>
                    <div class="mb-4">
                        <span>{{ strtoupper($paymentMethod ?? 'Belum dipilih') }}</span>
                        <button wire:click="openPaymentModal" class="ml-2 bg-blue-500 px-3 py-2 rounded text-white">Ubah</button>
                    </div>
                    @php
                        $showEditPayment = $showEditPayment ?? false;
                    @endphp
                   @if ($showEditPayment)
                        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                            @livewire('checkout.edit-payment-method')
                    @endif
                    </div>
                </div>

        <!-- Total Pembayaran -->
        <div class="p-6 bg-[#e3e9f7] rounded-lg">
            <div class="text-sm mb-2">
                <div class="flex justify-between">
                    <span>Subtotal Produk</span>
                    <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Subtotal Pengiriman</span>
                    <span>Rp{{ number_format($shippingCost ?? 2000, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Biaya Layanan</span>
                    <span>Rp{{ number_format($serviceFee ?? 2000, 0, ',', '.') }}</span>
                </div>
                @if ($discount > 0)
                    <div class="flex justify-between text-green-600 font-semibold">
                        <span>Diskon ({{ $voucherCode }})</span>
                        <span>- Rp{{ number_format($discount, 0, ',', '.') }}</span>
                    </div>
                @endif
                <hr class="my-2">
                <div class="flex justify-between font-bold text-lg">
                    <span>Total Pembayaran</span>
                    <span class="{{ $discount > 0 ? 'line-through text-red-500' : '' }}">
                        Rp{{ number_format($total + ($shippingCost ?? 2000) + ($serviceFee ?? 2000), 0, ',', '.') }}
                    </span>
                </div>
                @if ($discount > 0)
                    <div class="flex justify-end font-bold text-green-700 text-xl">
                        Rp{{ number_format(($total + ($shippingCost ?? 2000) + ($serviceFee ?? 2000)) - $discount, 0, ',', '.') }}
                    </div>
                @endif
            </div>
            <button class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                BELI
            </button>
        </div>
</div>
