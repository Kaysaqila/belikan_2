<?php

namespace App\Livewire\Checkout;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutComponent extends Component
{
    public $selectedProducts = [];
    public $total = 0;
    public $voucherCode;
    public $discount = 0;
    public $totalAfterDiscount = 0;
    public bool $showEditPayment = false;
    public $paymentMethod;

    public $userAddress;
    public $userNumber;

    protected $listeners = [
        'paymentMethodUpdated' => 'updatePaymentMethod',
        'closePaymentModal' => 'closePaymentModal',
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->userAddress = $user->address;
        $this->userNumber = $user->phone_number;

        $selectedCartIds = session('selected_cart_ids', []);
        $this->selectedProducts = Cart::with('product')
            ->whereIn('id', $selectedCartIds)
            ->where('user_id', $user->id)
            ->get();

        $this->total = $this->selectedProducts->sum(fn ($item) => $item->product->price * $item->quantity);
        $this->voucherCode = session('voucher_code', null);
        $this->discount = session('voucher_discount', 0);
        $this->totalAfterDiscount = $this->total - $this->discount;
    }

    public function render()
    {
        return view('livewire.checkout.checkout-component');
    }

    public function openPaymentModal()
    {
        $this->showEditPayment = true;
    }

    public function closePaymentModal()
    {
        $this->showEditPayment = false;
    }

    public function updatePaymentMethod($method)
    {
        $this->paymentMethod = $method;
        $this->showEditPayment = false;
    }
}
