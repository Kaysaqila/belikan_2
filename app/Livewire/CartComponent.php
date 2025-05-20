<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;

class CartComponent extends Component
{
    public $cart;
    public $selectedItems = [];
    public $selectAll = false;
    public $total = 0;
    public string $voucherCode = '';
    public $discount = 0;
    public $voucherApplied = false;
    public $totalAfterDiscount = 0;

    private array $availableVouchers = [
        'HEMAT10' => ['type' => 'fixed', 'value' => 10000],
        'DISKON20' => ['type' => 'percent', 'value' => 20],
        '7CHILL' => ['type' => 'percent', 'value' => 50],
    ];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = Cart::with('product')->get();
    }

    public function updatedSelectedItems()
    {
        $this->selectAll = count($this->selectedItems) === $this->cart->count();
        $this->updateTotal();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            // Kalau pilih semua, ambil semua ID dari cart
            $this->selectedItems = $this->cart->pluck('id')->toArray();
        } else {
            // Kalau tidak, kosongkan selectedItems
            $this->selectedItems = [];
        }

        $this->updateTotal();
    }

    public function incrementQuantity($id)
    {
        $item = Cart::find($id);
        $product = $item->product;

        if ($item->quantity < $product->stock) {
            $item->quantity += 1;
            $item->save();
        }

        $this->cart = Cart::with('product')->get();
        $this->updateTotal();
    }

    public function decrementQuantity($id)
    {
        $item = Cart::find($id);

        if ($item->quantity > 1) {
            $item->quantity -= 1;
            $item->save();
        }

        $this->cart = Cart::with('product')->get();
        $this->updateTotal();
    }

    public function updateTotal()
    {
        $subtotal = $this->cart
            ->whereIn('id', $this->selectedItems)
            ->sum(fn($item) => $item->product->price * $item->quantity);

        $this->total = $subtotal;
        $this->totalAfterDiscount = $subtotal - $this->discount;

        return $subtotal;
    }

    public function startCheckout()
    {
        session(['selected_cart_ids' => $this->selectedItems]);
        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.cart');
    }

    public function applyVoucher()
    {
        $code = strtoupper($this->voucherCode);

        if (!array_key_exists($code, $this->availableVouchers)) {
            $this->addError('voucherCode', 'Kode voucher tidak ditemukan.');
            return;
        }

        $voucher = $this->availableVouchers[$code];
        $total = $this->updateTotal();

        if ($voucher['type'] === 'fixed') {
            $this->discount = min($voucher['value'], $total);
        } elseif ($voucher['type'] === 'percent') {
            $this->discount = ($voucher['value'] / 100) * $total;
        }

        $this->voucherApplied = true;
        $this->updateTotal();

        session([
            'voucher_code' => $code,
            'voucher_discount' => $this->discount
        ]);
    }
}
