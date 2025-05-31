<?php

namespace App\Livewire\Checkout;

use Livewire\Component;

class Voucher extends Component
{
    public string $voucherCode = '';
    public $discount = 0;
    public $voucherApplied = false;

    private array $availableVouchers = [
        'HEMAT10' => ['type' => 'fixed', 'value' => 10000],
        'DISKON20' => ['type' => 'percent', 'value' => 20],
        '7CHILL' => ['type' => 'percent', 'value' => 50],
    ];

    public function applyVoucher()
    {
        $code = strtoupper($this->voucherCode);
        $total = session('checkout_total', 0); // total sebelum diskon harus di-set dari CheckoutComponent

        if (!array_key_exists($code, $this->availableVouchers)) {
            $this->addError('voucherCode', 'Kode voucher tidak ditemukan.');
            return;
        }

        $voucher = $this->availableVouchers[$code];

        if ($voucher['type'] === 'fixed') {
            $this->discount = min($voucher['value'], $total);
        } elseif ($voucher['type'] === 'percent') {
            $this->discount = ($voucher['value'] / 100) * $total;
        }

        $this->voucherApplied = true;

        session([
            'voucher_code' => $code,
            'voucher_discount' => $this->discount
        ]);
    }

    public function render()
    {
        return view('livewire.checkout.voucher');
    }
}
