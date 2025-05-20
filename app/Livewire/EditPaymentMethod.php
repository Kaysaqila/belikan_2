<?php

namespace App\Livewire;

use Livewire\Component;

class EditPaymentMethod extends Component
{
    public $selectedMethod; //variabel untuk menyimpan pilihan payment
    public $showEditPayment = false;

    public $paymentMethods = [ //array buat nyimpen value
        'bca' => 'BCA',
        'mandiri' => 'MANDIRI',
        'bri' => 'BRI',
        'dana' => 'DANA',
        'cod' => 'COD',
    ];

    public function selectMethod($method) //function untuk pilih metode pembayaran
    {
        $this->selectedMethod = $method;
    }

    public function confirmSelection()
    {
        if ($this->selectedMethod) {
            $this->dispatch('paymentMethodSelected', $this->selectedMethod);
            $this->dispatch('paymentMethodUpdated', $this->selectedMethod);
            $this->dispatch('closePaymentModal'); // ⬅️ Tambahin ini!
            $this->closeModal(); // ini tetap buat nutup modal versi child
        }
    }

    public function openPaymentModal()
    {
        $this->showEditPayment = true;
    }

    public function closeModal()
    {
        $this->showEditPayment = false;
    }
    
    public function render()
    {
        return view('livewire.edit-payment-method');
    }
}
