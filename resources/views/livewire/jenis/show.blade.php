<x-app-layout>
<div class="flex flex-col md:flex-row gap-8 p-8 justify-center items-center mt-8">
    <!-- Gambar -->
    <div class="w-full md:w-1/2 max-w-md">
    <div class="w-120 h-80 bg-gray-100 flex items-center justify-center overflow-hidden rounded-lg shadow-lg p-2 bg-white">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
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
    <livewire:jenis.show-jenis :id="$product->id" />
    
</div>
</x-app-layout>