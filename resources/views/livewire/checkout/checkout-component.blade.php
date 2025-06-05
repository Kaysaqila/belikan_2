<div class="min-h-screen bg-gradient-to-br from-[#071e3d] to-[#0f2744] p-4 sm:p-6">
    <div class="max-w-4xl mx-auto space-y-6">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Checkout</h1>
            <p class="text-blue-200">Lengkapi informasi pemesanan Anda</p>
        </div>

        <!-- Alamat Pengiriman -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Alamat Pengiriman
                </h2>
                <button wire:click="openEditAddressModal" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 text-sm font-medium">
                    Ubah Alamat
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-gray-700">
                <div class="space-y-1">
                    <p class="text-sm font-medium text-gray-500">Nama Penerima</p>
                    <p class="font-medium">{{ $shippingName ?? 'Belum diatur' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-sm font-medium text-gray-500">Alamat Lengkap</p>
                    <p class="font-medium">{{ $shippingAddress ?? 'Belum diatur' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-sm font-medium text-gray-500">Nomor Telepon</p>
                    <p class="font-medium">{{ $shippingNumber ?? 'Belum diatur' }}</p>
                </div>
            </div>

            <!-- Modal Edit Address -->
            @if ($showEditAddress ?? false)
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                    <div class="bg-white rounded-xl max-w-md w-full">
                        @livewire('checkout.edit-alamat-penerima')
                    </div>
                </div>
            @endif
        </div>

        <!-- Produk Pesanan -->
        @if ($selectedProducts && count($selectedProducts) > 0)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Produk Pesanan
                    </h2>
                </div>

                <!-- Header Tabel -->
                <div class="hidden md:grid md:grid-cols-4 bg-gray-50 px-6 py-3 text-sm font-semibold text-gray-700">
                    <div>Produk</div>
                    <div class="text-center">Harga Satuan</div>
                    <div class="text-center">Jumlah</div>
                    <div class="text-center">Subtotal</div>
                </div>

                <!-- Produk Items -->
                <div class="divide-y divide-gray-200">
                    @foreach ($selectedProducts as $item)
                        <div class="p-6" wire:key="selected-{{ $item->id }}">
                            <!-- Desktop Layout -->
                            <div class="hidden md:grid md:grid-cols-4 items-center">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-16 h-16 object-cover rounded-lg"
                                         wire:ignore>
                                    <div>
                                        <h3 class="font-medium text-gray-800">{{ $item->product->name }}</h3>
                                    </div>
                                </div>
                                <div class="text-center text-gray-700">
                                    Rp{{ number_format($item->product->price, 0, ',', '.') }}
                                </div>
                                <div class="text-center font-medium">
                                    {{ $item->quantity }}
                                </div>
                                <div class="text-center font-semibold text-gray-800">
                                    Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                </div>
                            </div>

                            <!-- Mobile Layout -->
                            <div class="md:hidden">
                                <div class="flex items-start space-x-4">
                                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-16 h-16 object-cover rounded-lg flex-shrink-0"
                                         wire:ignore>
                                    <div class="flex-1 space-y-2">
                                        <h3 class="font-medium text-gray-800">{{ $item->product->name }}</h3>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Harga: Rp{{ number_format($item->product->price, 0, ',', '.') }}</span>
                                            <span class="text-gray-600">Qty: {{ $item->quantity }}</span>
                                        </div>
                                        <div class="font-semibold text-gray-800">
                                            Subtotal: Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Voucher Section -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                Voucher Diskon
            </h3>

            @if ($voucherCode)
                <div class="flex items-center justify-between bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-green-100 p-2 rounded-full">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-green-800">Voucher "{{ $voucherCode }}" diterapkan</p>
                            <p class="text-sm text-green-600">Diskon: Rp{{ number_format($discount, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <button wire:click="resetVoucher" 
                            class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-sm transition-colors">
                        Hapus
                    </button>
                </div>
            @else
                <button wire:click="openVoucher" 
                        class="w-full border-2 border-dashed border-gray-300 rounded-lg p-4 text-gray-600 hover:border-blue-400 hover:text-blue-600 transition-colors">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Pilih Voucher Diskon
                </button>
            @endif

            @if ($showVoucher ?? false)
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                    <div class="bg-white rounded-xl max-w-md w-full">
                        @livewire('checkout.voucher', ['total' => $total])
                    </div>
                </div>
            @endif

            @error('voucherCode')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Catatan, Pengiriman, dan Pembayaran -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Catatan -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Catatan Pemesanan</h3>
                    <textarea wire:model="note" 
                              placeholder="Tinggalkan catatan untuk penjual (opsional)"
                              class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                              rows="3"></textarea>
                </div>

                <!-- Opsi Pengiriman -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2v0a2 2 0 01-2-2v-2a2 2 0 00-2-2H8z"/>
                            </svg>
                            Opsi Pengiriman
                        </h3>
                        <button wire:click="openOpsiKirim" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                            Ubah
                        </button>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="font-medium text-gray-800">
                            @if($selectedShippingOption)
                                {{ strtoupper($shippingOptions[$selectedShippingOption]['label'] ?? 'Belum dipilih') }}
                            @else
                                Belum dipilih
                            @endif
                        </p>
                    </div>

                    @if ($showOpsiKirim ?? false)
                        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                            <div class="bg-white rounded-xl max-w-md w-full">
                                @livewire('checkout.edit-opsi-kirim')
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Metode Pembayaran -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Metode Pembayaran
                        </h3>
                        <button wire:click="openPaymentModal" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                            Ubah
                        </button>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="font-medium text-gray-800">
                            {{ strtoupper($paymentMethod ?? 'Belum dipilih') }}
                        </p>
                    </div>

                    @if ($showEditPayment ?? false)
                        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                            <div class="bg-white rounded-xl max-w-md w-full">
                                @livewire('checkout.edit-payment-method')
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Ringkasan Pembayaran -->
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Pembayaran</h3>
                    
                    <div class="space-y-3 text-gray-700">
                        <div class="flex justify-between">
                            <span>Subtotal Produk</span>
                            <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Pengiriman</span>
                            <span>Rp{{ number_format($shippingCost ?? 2000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Layanan</span>
                            <span>Rp{{ number_format($serviceFee ?? 2000, 0, ',', '.') }}</span>
                        </div>
                        
                        @if ($discount > 0)
                            <div class="flex justify-between text-green-600 font-medium">
                                <span>Diskon ({{ $voucherCode }})</span>
                                <span>- Rp{{ number_format($discount, 0, ',', '.') }}</span>
                            </div>
                        @endif
                    </div>

                    <hr class="my-4">

                    @php
                        $grandTotal = $total + ($shippingCost ?? 2000) + ($serviceFee ?? 2000);
                        $finalTotal = $grandTotal - $discount;
                    @endphp

                    @if ($discount > 0)
                        <div class="flex justify-between text-gray-500 line-through mb-2">
                            <span class="font-semibold">Total</span>
                            <span>Rp{{ number_format($grandTotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-xl font-bold text-green-700">
                            <span>Total Setelah Diskon</span>
                            <span>Rp{{ number_format($finalTotal, 0, ',', '.') }}</span>
                        </div>
                    @else
                        <div class="flex justify-between text-xl font-bold text-gray-800">
                            <span>Total Pembayaran</span>
                            <span>Rp{{ number_format($grandTotal, 0, ',', '.') }}</span>
                        </div>
                    @endif

                    <button wire:click="placeOrder" 
                            class="w-full mt-6 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-6 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                        <span class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            <span>Beli Sekarang</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>