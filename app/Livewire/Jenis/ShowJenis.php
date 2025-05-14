<?php

namespace App\Livewire\Jenis;

use App\Models\Product;
use Livewire\Component;

class ShowJenis extends Component
{
    public $product;
    public $quantity = 1;

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->product->stock) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function render()
    {
        return view('livewire.jenis.show-jenis');
    }
}
