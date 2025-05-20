<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class CheckoutComponent extends Component
{
    public $selectedProducts = [];
    public $total = 0;
    public $voucherCode;
    public $discount = 0;
    public $totalAfterDiscount = 0;
    public $showEditPayment = false;
    public $paymentMethod;

    protected $listeners = [
        'closePaymentModal' => 'closeModal',
        'paymentMethodUpdated' => 'paymentMethodUpdated'
    ];

    public function mount()
    {
        $selectedCartIds = session('selected_cart_ids', []);
        $this->selectedProducts = \App\Models\Cart::with('product')
            ->whereIn('id', $selectedCartIds)
            ->where('user_id', auth()->id())
            ->get();

        $this->total = $this->selectedProducts->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $this->voucherCode = session('voucher_code', null);
        $this->discount = session('voucher_discount', 0);
        $this->totalAfterDiscount = $this->total - $this->discount;

    }

    public function render()
    {
        return view('livewire.checkout-component');
    }

    public function openPaymentModal()
    {
        $this->showEditPayment = true;
    }

    public function paymentMethodSelected($method)
    {
        $this->paymentMethod = $method;
        $this->showEditPayment = false;
    }

    public function closeModal()
    {
        $this->showEditPayment = false;
    }

    public function paymentMethodUpdated($method)
    {
        $this->paymentMethod = $method;
    }
}
