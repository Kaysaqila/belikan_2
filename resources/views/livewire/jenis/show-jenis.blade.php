<div class="w-full lg:w-1/2 bg-white p-4 rounded-lg shadow-md border">
    <h3 class="text-lg font-bold mb-2">{{ $product->name }}</h3>
    <p class="text-gray-600 mb-2">Stok Tersedia: {{ $product->stock }}</p>

    <div class="flex items-center gap-2 mb-4">
        <button wire:click="decrementQuantity" class="px-3 py-1 bg-gray-200 rounded text-lg">-</button>
        <span class="text-lg font-semibold">{{ $quantity }}</span>
        <button wire:click="incrementQuantity" class="px-3 py-1 bg-gray-200 rounded text-lg">+</button>
    </div>

    <p class="font-bold text-xl text-gray-800 mb-4">
        Subtotal: Rp{{ number_format($product->price * $quantity, 0, ',', '.') }}
    </p>
    
    <livewire:add-to-cart-button :productId="$product->id" />

    
</div>
