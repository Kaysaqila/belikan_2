<?php

namespace App\Livewire\Checkout;

use Livewire\Component;

class Voucher extends Component
{
    public string $voucherCode = '';
    public bool $voucherApplied = false;
    public $discount = 0;
    public $total;

    private array $availableVouchers = [
        'HEMAT10' => ['type' => 'fixed', 'value' => 10000],
        'DISKON20' => ['type' => 'percent', 'value' => 20],
        '7CHILL' => ['type' => 'percent', 'value' => 50],
    ];

    public function applyVoucher()
    {
        $code = strtoupper($this->voucherCode);

        if (!array_key_exists($code, $this->availableVouchers)) {
            $this->addError('voucherCode', 'Kode voucher tidak valid.');
            $this->voucherApplied = false;
            return;
        }

        $voucher = $this->availableVouchers[$code];

        if ($voucher['type'] === 'fixed') {
            $this->discount = $voucher['value'];
        } elseif ($voucher['type'] === 'percent') {
            $this->discount = intval($this->total * ($voucher['value'] / 100));
        }

       $this->dispatch('voucherApplied', $this->discount, $code);

        // 🔥 Kirim event ke browser untuk menutup modal
        $this->dispatch('closeVoucher'); 
    }

    public function render()
    {
        return view('livewire.checkout.voucher');
    }
}
