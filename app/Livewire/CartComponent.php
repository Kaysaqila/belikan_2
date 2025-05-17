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
        $cartItem = Cart::find($id);
        $cartItem->quantity += 1;
        $cartItem->save();

        $this->loadCart();
        $this->updateTotal();
    }

    public function decrementQuantity($id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
        }

        $this->loadCart();
        $this->updateTotal();
    }

    public function updateTotal()
    {
        $this->total = $this->cart->whereIn('id', $this->selectedItems)->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
