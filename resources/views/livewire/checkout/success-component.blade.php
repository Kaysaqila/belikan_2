<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes checkmark {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .animate-slide-in {
            animation: slideIn 0.6s ease-out;
        }
        
        .animate-checkmark {
            animation: checkmark 0.8s ease-out;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <div class="container mx-auto px-4 py-8 min-h-screen flex items-center justify-center">
        <div class="max-w-2xl w-full mx-auto bg-white rounded-2xl shadow-2xl overflow-hidden animate-slide-in">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-green-400 to-green-600 px-6 py-8 text-center text-white">
                <div class="animate-checkmark">
                    <svg class="mx-auto h-16 w-16 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold mb-2">Pembayaran Berhasil!</h1>
                <p class="text-green-100 text-lg">Terima kasih telah berbelanja dengan kami</p>
            </div>

            <div class="p-8">
                <!-- Order Details Section -->
                <div class="bg-gray-50 rounded-xl p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 102 0V3h4v1a1 1 0 102 0V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                        Detail Pesanan
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">No. Order:</span>
                                <span class="text-gray-800 font-semibold">#{{ $order->id ?? 'ORD-12345' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Total Pembayaran:</span>
                                <span class="text-green-600 font-bold text-lg">Rp{{ number_format($order->total_amount ?? 150000, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Metode Pengiriman:</span>
                                <span class="text-gray-800 font-semibold">{{ ucfirst($order->shipping_method ?? 'Regular') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">Metode Pembayaran:</span>
                                <span class="text-gray-800 font-semibold">{{ ucfirst($order->payment_method ?? 'Regular') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address Section -->
                <div class="bg-blue-50 rounded-xl p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        Alamat Pengiriman
                    </h2>
                    <div class="space-y-2">
                        <p class="text-gray-800 font-semibold text-lg">{{ $order->shippingAddress->recipient_name ?? 'John Doe' }}</p>
                        <p class="text-gray-700 leading-relaxed">{{ $order->shippingAddress->address ?? 'Jl. Contoh Alamat No. 123, Kelurahan ABC, Kecamatan DEF, Kota GHI, Provinsi JKL 12345' }}</p>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            <span>{{ $order->shippingAddress->phone_number ?? '081234567890' }}</span>
                        </div>
                        @if(isset($order->shippingAddress->note) && $order->shippingAddress->note)
                            <div class="mt-3 p-3 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                                <p class="text-sm text-yellow-800"><strong>Catatan:</strong> {{ $order->shippingAddress->note }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/dashboard" class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-8 rounded-xl transition duration-300 transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>