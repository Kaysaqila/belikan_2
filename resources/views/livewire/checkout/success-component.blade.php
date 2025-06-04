<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="text-center mb-6">
            <svg class="mx-auto h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <h1 class="text-2xl font-bold text-gray-800 mt-4">Pembayaran Berhasil!</h1>
            <p class="text-gray-600 mt-2">Terima kasih telah berbelanja dengan kami</p>
        </div>

        <div class="border-t border-b border-gray-200 py-4">
            <h2 class="text-lg font-semibold text-gray-800">Detail Pesanan</h2>
            <p class="text-gray-600 mt-1">No. Order: {{ $order->id }}</p>
            <p class="text-gray-600">Total Pembayaran: Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>
            <p class="text-gray-600">Metode Pengiriman: {{ ucfirst($order->shipping_method) }}</p>
        </div>

        <div class="mt-6">
            <h2 class="text-lg font-semibold text-gray-800">Alamat Pengiriman</h2>
            <p class="text-gray-600 mt-1">{{ $order->shippingAddress->recipient_name }}</p>
            <p class="text-gray-600">{{ $order->shippingAddress->address }}</p>
            <p class="text-gray-600">Telp: {{ $order->shippingAddress->phone_number }}</p>
            @if($order->shippingAddress->note)
                <p class="text-gray-600">Catatan: {{ $order->shippingAddress->note }}</p>
            @endif
        </div>

        <div class="mt-8 text-center">
            <a href="/dashboard" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>