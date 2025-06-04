<?php

namespace App\Livewire\Checkout;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class SuccessComponent extends Component
{
    public $order;

    public function mount()
    {
        // Ambil order terakhir user
        $this->order = Order::with(['orderItems.product', 'shippingAddress'])
            ->where('user_id', Auth::id())
            ->latest()
            ->first();
        
        if (!$this->order) {
            return redirect('/');
        }
    }

    public function render()
    {
        return view('livewire.checkout.success-component');
    }
}