<?php

namespace App\Livewire\Checkout;

use Livewire\Component;

class EditOpsiKirim extends Component
{
    public $selectedOption;

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

    public function selectOption($option)
    {
        $this->selectedOption = $option;
    }

    public function confirmSelection()
    {
        if ($this->selectedOption) {
            $this->dispatch('shippingOptionUpdated', $this->selectedOption);
            $this->dispatch('shippingOptionSelected', $this->selectedOption);
            $this->dispatch('closeOpsiKirim');
        }
    }
    
    public function render()
    {
        return view('livewire.checkout.edit-opsi-kirim');
    }
}
