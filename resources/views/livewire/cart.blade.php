<div>
    <h2 class="text-xl font-semibold mb-4">Keranjang Belanja</h2>

    @forelse ($cartItems as $item)
        <div class="border p-4 rounded mb-2 flex justify-between items-center">
            <div>
                <strong>{{ $item->product->name }}</strong><br>
                Rp{{ number_format($item->product->price, 0, ',', '.') }} x {{ $item->quantity }}
            </div>
            <button wire:click="removeFromCart({{ $item->id }})"
                    class="text-red-600 hover:underline">Hapus</button>
        </div>
    @empty
        <p>Keranjang masih kosong.</p>
    @endforelse
</div>
