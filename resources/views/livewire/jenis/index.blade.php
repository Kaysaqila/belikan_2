<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        AOS.init({
            duration: 500,
        });
    });
</script>

<div>
<section class="relative w-full h-[500px] bg-[#2196F3] overflow-hidden">
    <!-- Gelembung -->
    <div class="absolute inset-0 left-20">
        <div class="absolute w-10 h-10 bg-blue-200 rounded-full opacity-70 top-10 left-10 animate-bounce"></div>
        <div class="absolute w-8 h-8 bg-blue-300 rounded-full opacity-40 top-32 left-32 animate-pulse"></div>
        <div class="absolute w-6 h-6 bg-blue-100 rounded-full opacity-40 top-64 left-20 animate-bounce"></div>
    </div>

    <!-- Teks -->
    <div class="absolute top-1/3 left-60 z-10">
        <h1 class="text-white text-4xl font-bold leading-tight mb-4">
            Ikan <br />
            Impianmu <br />
            Menunggu!
        </h1>
        <a href="#" class="bg-white text-[#00ADEF] font-semibold px-5 py-2 rounded-full shadow hover:bg-blue-100">
            Buy Now!
        </a>
    </div>

    <!-- Gambar Ikan -->
    <div class="absolute top-0 right-40 h-full flex items-center justify-center pr-10 z-0">
        <img src="{{ asset('images/jenis.png') }}" alt="Ikan Cupang" class="h-[400px] object-contain">
    </div>

    <div class="wave-container">
    <svg class="wave" viewBox="0 0 1200 120" preserveAspectRatio="none">
    <path d="M0,60 
         C150,90 300,30 450,60 
         C600,90 750,30 900,60 
         C1050,90 1200,30 1350,60 
         L1350,120 L0,120 Z" fill="#FFFFFF"/>
    </svg>
    </div>
</section>

<form method="GET" id="sortForm">
    <div class="mb-3">
        <select name="sort" id="sort"
            class="bg-black text-white uppercase px-4 py-2 rounded cursor-pointer ml-20"
            onchange="document.getElementById('sortForm').submit();">
            <option value="">SORT BY:</option>
            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
        </select>
    </div>
</form>

<div class="grid grid-cols-4 gap-8 m-4 p-4">
    @forelse($products as $product)
        <a href="{{ route('jenis.show', $product->id) }}"
            class="block {{ $product->stock <= 0  }}">
            <div 
                class="relative bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 dark:bg-gray-800 dark:border-gray-700 m-2 p-2 hover:shadow-lg transition-shadow {{ $product->stock <= 0 ? 'opacity-50 grayscale' : '' }}" 
                data-aos="fade-up" 
                data-aos-anchor-placement="center-bottom">
                <div class="relative">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover" alt="{{ $product->name }}">
                    
                    @if ($product->stock == 0)
                        <div class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded shadow z-10">
                            SOLD OUT
                        </div>
                    @endif
                </div>

                <div class="text-center p-4">
                    <h5 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $product->name }}</h5>
                    <p class="text-gray-600 dark:text-gray-300">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-sm text-muted">Sisa stok: {{ $product->stock }}</p>
                </div>
            </div>
        </a>
    @empty
        <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
            Tidak ada produk dalam kategori ini.
        </div>
    @endforelse
</div>

 <!-- Footer -->
 <footer class="bg-black text-gray-400 text-sm p-6 grid grid-cols-4 gap-4">
        <div>
            <h3 class="font-semibold text-white">Tentang Kami</h3>
            <p>Cerita Kami</p>
            <p>Siapa BeliKAN?</p>
            <p>Karier</p>
        </div>
        <div>
            <h3 class="font-semibold text-white">Layanan</h3>
            <p>Belanja Online</p>
            <p>Pengiriman Cepat</p>
            <p>Customer Support</p>
        </div>
        <div>
            <h3 class="font-semibold text-white">Sosial Media</h3>
            <p class="flex items-center gap-2">
                <i class="bi bi-facebook"></i>
                @belikan_official
            </p>
            <p class="flex items-center gap-2">
                <i class="bi bi-tiktok"></i>
                @belikan_official
            </p>
            <p class="flex items-center gap-2">
                <i class="bi bi-instagram"></i>
                @belikan_official
            </p>
            <p class="flex items-center gap-2">
                <i class="bi bi-youtube"></i>
                BELIKAN_official
            </p>
        </div>
        <div>
            <h3 class="font-semibold text-white">Kontak Kami</h3>
            <p class="flex items-center gap-2">
                <i class="bi bi-geo-alt-fill"></i>
                Jl. Kenangan
            </p>
            <p class="flex items-center gap-2">
                <i class="bi bi-telephone-fill"></i>
                +62 85858585858
            </p>
            <p class="flex items-center gap-2">
                <i class="bi bi-envelope-fill"></i>
                hallo@belikan.id
            </p>
        </div>
    </footer>
</div>