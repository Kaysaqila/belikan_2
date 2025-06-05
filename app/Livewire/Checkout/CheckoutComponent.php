<?php

namespace App\Livewire\Checkout;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Auth;

class CheckoutComponent extends Component
{
    public $selectedProducts = [];
    public $total = 0;
    public $voucherCode;
    public $discount = 0;
    public $totalAfterDiscount = 0;
    public bool $showEditPayment = false;
    public bool $showEditAddress = false;
    public bool $showVoucher = false;
    public bool $showOpsiKirim = false;
    public $selectedShippingOption = null;
    public $paymentMethod;
    public $voucherApplied = false; // opsional, kalau mau tandai berhasil atau belum

    public $shippingAddress, $shippingNumber, $shippingName, $note;

    protected $listeners = [
        'paymentMethodUpdated' => 'updatePaymentMethod', // update metode pembayaran
        'shippingOptionUpdated' => 'updateShippingOption', // update opsi kirim
        'closePaymentModal' => 'closePaymentModal',
        'closeEditAddressModal' => 'closeEditAddressModal',
        'closeVoucher' => 'closeVoucher',
        'closeOpsiKirim' => 'closeOpsiKirim', 
        'addressUpdated' => 'refreshShippingData',
        'voucherApplied' => 'handleVoucherApplied', // update harga setelah ada voucher
    ];

    public function mount()
    {
        $user = Auth::user();

        // Ambil alamat default (tanpa order_id)
        $shipping = ShippingAddress::where('user_id', $user->id)
            ->whereNull('order_id')
            ->latest()
            ->first();

        $this->shippingAddress = $shipping?->address ?? $user->address;
        $this->shippingNumber = $shipping?->phone_number ?? $user->phone_number;
        $this->shippingName = $shipping?->recipient_name ?? $user->name;

        $selectedCartIds = session('selected_cart_ids', []);
        $this->selectedProducts = Cart::with('product')
            ->whereIn('id', $selectedCartIds)
            ->where('user_id', $user->id)
            ->get();

        // Cek apakah isi keranjang berubah
        $lastCartIds = session('last_cart_ids', []);
        if ($selectedCartIds !== $lastCartIds) {
            session()->forget(['voucher_code', 'voucher_discount']); // Hapus voucher
        }

        // Simpan daftar keranjang terbaru
        session(['last_cart_ids' => $selectedCartIds]);

        $this->total = $this->selectedProducts->sum(fn ($item) => $item->product->price * $item->quantity);
        $this->voucherCode = session('voucher_code', null);
        $this->discount = session('voucher_discount', 0);
        $this->totalAfterDiscount = $this->total - $this->discount;
    }

    public function refreshShippingData()
    {
        $user = Auth::user();
        $shipping = ShippingAddress::where('user_id', $user->id)
            ->whereNull('order_id')
            ->latest()
            ->first();
        
        $this->shippingAddress = $shipping?->address ?? $user->address;
        $this->shippingNumber = $shipping?->phone_number ?? $user->phone_number;
        $this->shippingName = $shipping?->recipient_name ?? $user->name;
        $this->note = $shipping?->note ?? '';
    }

    public function placeOrder()
    {
        $selectedCartIds = session('selected_cart_ids', []);
        $voucherCode = session('voucher_code');
        $voucherDiscount = session('voucher_discount', 0);

        $cartItems = Cart::whereIn('id', $selectedCartIds)->get();

        if ($cartItems->isEmpty()) {
            session()->flash('error', 'Tidak ada produk yang dipilih.');
            return;
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $total -= $voucherDiscount;

        // Buat Order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'voucher_code' => $voucherCode,
            'voucher_discount' => $voucherDiscount,
            'shipping_method' => $this->selectedShippingOption,
            'payment_method' => $this->paymentMethod,
            'status' => 'pending',
        ]);

        // Simpan item ke OrderItem dan kurangi stok produk
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            // Kurangi stok produk
            $item->product->decrement('stock', $item->quantity);
        }

        // Hanya buat/mengupdate shipping address JIKA BELUM ADA untuk order ini
        ShippingAddress::updateOrCreate(
            ['order_id' => $order->id],
            [
                'user_id' => Auth::id(),
                'recipient_name' => $this->shippingName,
                'address' => $this->shippingAddress,
                'phone_number' => $this->shippingNumber,
                'note' => $this->note,
            ]
        );

        // Hapus item cart
        Cart::whereIn('id', $selectedCartIds)->delete();

        session()->flash('success', 'Pesanan berhasil dibuat!');
        return redirect()->route('checkout.success');
    }

    public function handleVoucherApplied($discount, $code)
    {
        $this->discount = $discount;
        $this->voucherCode = $code;
        $this->totalAfterDiscount = $this->total - $this->discount;
        $this->voucherApplied = true;

        session([
            'voucher_code' => $code,
            'voucher_discount' => $discount
        ]);
    }

    public function resetVoucher()
    {
        session()->forget(['voucher_code', 'voucher_discount']);
        $this->voucherCode = null;
        $this->discount = 0;
        $this->totalAfterDiscount = $this->total;
        $this->voucherApplied = false;
    }

    public function updatePaymentMethod($method)
    {
        $this->paymentMethod = $method;
        $this->showEditPayment = false;
    }

    public function updateShippingOption($option)
    {
        $this->selectedShippingOption = $option;
        $this->showOpsiKirim = false;
    }

    public $shippingOptions = [
        'reguler' => [
            'label' => 'Reguler',
            'price' => 15000,
            'guarantee' => '2-3 hari kerja'
        ],
        'hemat' => [
            'label' => 'Hemat',
            'price' => 11000,
            'guarantee' => '3-5 hari kerja'
        ]
    ];

    public function render()
    {
        return view('livewire.checkout.checkout-component');
    }

    public function openPaymentModal() //pembayaran
    {
        $this->showEditPayment = true;
    }

    public function closePaymentModal()
    {
        $this->showEditPayment = false;
    }

    public function openEditAddressModal() //address
    {
        $this->showEditAddress = true;
    }

    public function closeEditAddressModal()
    {
        $this->showEditAddress = false;
    }

    public function openVoucher() //voucher
    {
        $this->showVoucher = true;
    }

    public function closeVoucher()
    {
        $this->showVoucher = false;
    }

    public function openOpsiKirim() //opsi kirim
    {
        $this->showOpsiKirim = true;
    }

    public function closeOpsiKirim()
    {
        $this->showOpsiKirim = false;
    }
}