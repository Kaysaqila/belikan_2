<?php

namespace App\Livewire\Checkout;

use Livewire\Component;

class EditPaymentMethod extends Component
{
    public $selectedMethod;

    public $paymentMethods = [
        'bca' => 'BCA',
        'mandiri' => 'MANDIRI',
        'bri' => 'BRI',
        'dana' => 'DANA',
        'cod' => 'COD',
    ];

    public function selectMethod($method)
    {
        $this->selectedMethod = $method;
    }

    public function confirmSelection()
    {
        if ($this->selectedMethod) {
            $this->dispatch('paymentMethodSelected', $this->selectedMethod);
            $this->dispatch('paymentMethodUpdated', $this->selectedMethod);
            $this->dispatch('closePaymentModal'); // cukup ini aja
        }
    }

    public function render()
    {
        return view('livewire.checkout.edit-payment-method');
    }
}
