<div class="bg-white min-h-screen">
    <!-- Header Tabel Keranjang -->
    <div class="px-6 mt-6">
        <div class="grid grid-cols-5 font-semibold bg-[#002060] text-white rounded-t-lg p-4">
            <div class="col-span-2 pl-32">Produk</div>
            <div class="text-center">Harga Satuan</div>
            <div class="text-center">Kuantitas</div>
            <div class="text-center">Total</div>
        </div>

        <!-- Item Keranjang -->
        @forelse ($cart as $item)
            <div class="grid grid-cols-5 items-center border border-gray-200 p-4 bg-white hover:bg-gray-50 transition-colors" 
                 wire:key="row-{{ $item->id }}">
                
                <!-- Kolom Produk (Checkbox + Gambar + Nama) -->
                <div class="col-span-2 flex items-center space-x-4">
                    <input type="checkbox" 
                           wire:model.live="selectedItems" 
                           value="{{ $item->id }}" 
                           class="checkbox-item w-4 h-4 text-[#002060] rounded focus:ring-[#002060]" />
                    
                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                         alt="{{ $item->product->name }}" 
                         class="w-20 h-20 object-cover rounded-lg shadow-sm"
                         wire:ignore />
                    
                    <div class="flex-1">
                        <h3 class="font-medium text-gray-800 text-sm">{{ $item->product->name }}</h3>
                    </div>
                </div>

                <!-- Kolom Harga Satuan -->
                <div class="text-center">
                    <span class="text-gray-700 font-medium">
                        Rp{{ number_format($item->product->price, 0, ',', '.') }}
                    </span>
                </div>

                <!-- Kolom Kuantitas dan Tombol Hapus -->
                <div class="flex items-center justify-center space-x-3">
                    <!-- Tombol Hapus -->
                    <button wire:click="removeItem({{ $item->id }})"
                            class="text-gray-400 hover:text-red-500 transition-colors p-1"
                            title="Hapus item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22"/>
                        </svg>
                    </button>

                    <!-- Kontrol Kuantitas -->
                    <div class="flex items-center border border-gray-300 rounded-full px-3 py-1">
                        <button wire:click="decrementQuantity({{ $item->id }})"
                                class="text-gray-600 hover:text-[#002060] transition-colors w-6 h-6 flex items-center justify-center"
                                title="Kurangi jumlah">
                            <span class="text-lg font-medium">−</span>
                        </button>
                        
                        <span class="mx-3 text-sm font-medium text-gray-800 min-w-[2rem] text-center">
                            {{ $item->quantity }}
                        </span>
                        
                        <button wire:click="incrementQuantity({{ $item->id }})"
                                class="text-gray-600 hover:text-[#002060] transition-colors w-6 h-6 flex items-center justify-center"
                                title="Tambah jumlah">
                            <span class="text-lg font-medium">+</span>
                        </button>
                    </div>
                </div>

                <!-- Kolom Total Harga -->
                <div class="text-center">
                    <span class="font-semibold text-gray-800">
                        Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        @empty
            <!-- State Kosong -->
            <div class="text-center py-12 border border-gray-200 rounded-b-lg bg-gray-50">
                <div class="text-gray-400 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" 
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0L17 18H9"/>
                    </svg>
                </div>
                <p class="text-gray-500">Keranjang belanja Anda masih kosong</p>
                <p class="text-sm text-gray-400 mt-1">Mulai berbelanja untuk menambahkan produk</p>
            </div>
        @endforelse
    </div>

    <!-- Section Checkout -->
    <div class="bg-gray-50 mt-8 p-6 border-t border-gray-200">
        <!-- Header Section -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Ringkasan Belanja</h2>
        </div>

        <!-- Footer Checkout -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0 border-t border-gray-300 pt-6">
            <!-- Pilih Semua -->
            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox" 
                       wire:model.live="selectAll" 
                       class="w-4 h-4 text-[#002060] rounded focus:ring-[#002060]" />
                <span class="text-gray-700 font-medium">Pilih Semua</span>
            </label>

            <!-- Total dan Checkout -->
            <div class="flex items-center space-x-6">
                <div class="text-right">
                    <p class="text-sm text-gray-600">Total Pembayaran</p>
                    <p class="text-xl font-bold text-[#002060]">
                        Rp{{ number_format($total, 0, ',', '.') }}
                    </p>
                </div>
                
                <button wire:click="startCheckout"
                        class="bg-[#002060] text-white px-6 py-3 rounded-lg font-medium 
                               hover:bg-[#001540] transition-colors shadow-sm
                               disabled:bg-gray-300 disabled:cursor-not-allowed"
                        {{ count($selectedItems ?? []) === 0 ? 'disabled' : '' }}>
                    Checkout Sekarang
                </button>
            </div>
        </div>
    </div>
</div>