<x-app-layout>
<div class="flex flex-col md:flex-row gap-8 p-8 justify-center items-center mt-8">
    <!-- Gambar -->
    <div class="w-full md:w-1/2 max-w-md">
    <div class="relative rounded-lg overflow-hidden shadow-lg p-2 bg-white">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
             class="w-full object-cover rounded-md">
    </div>
    </div>

    <!-- Informasi Produk n jumlah beli -->
    <div class="md:w-1/2 flex flex-col lg:flex-row justify-between gap-6">
    <div class="flex-1">
    <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
    <p class="text-xl font-semibold text-blue-600 mt-2">Rp{{ number_format($product->price, 0, ',', '.') }}</p>

    <hr class="my-2">

    <h2 class="text-lg font-bold mb-2">Deskripsi</h2>
    <hr class="my-2">

    <div class="text-gray-700 ml-6 space-y-1">
        {!! $product->description ?? '-' !!}
    </div>
    <hr class="my-2">
</div>

<!-- Card Jumlah Beli -->
<div class="w-full lg:w-1/2 bg-white p-4 rounded-lg shadow-md border">
    <h3 class="text-lg font-bold mb-2">Jumlah Beli</h3>
    <p class="text-gray-600 mb-2">Stok Tersedia: {{ $product->stock }}</p>

    <div class="flex items-center gap-2 mb-4">
        <button class="px-3 py-1 bg-gray-200 rounded text-lg">-</button>
        <span class="text-lg font-semibold">2</span>
        <button class="px-3 py-1 bg-gray-200 rounded text-lg">+</button>
    </div>

    <p class="font-bold text-xl text-gray-800 mb-4">Subtotal: Rp{{ number_format($product->price * 2, 0, ',', '.') }}</p>

    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mb-2">
        + Keranjang
    </button>
    <button class="w-full border border-blue-600 text-blue-600 hover:bg-blue-100 font-semibold py-2 px-4 rounded">
        Beli Sekarang
    </button>
</div>
</div>
</x-app-layout>