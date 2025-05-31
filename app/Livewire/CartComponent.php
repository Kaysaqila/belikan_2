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
        $item = Cart::find($id);
        $product = $item->product;

        if ($item->quantity < $product->stock) {
            $item->quantity += 1;
            $item->save();
        }

        $this->cart = Cart::with('product')->get();
        $this->updateTotal();
    }

    public function decrementQuantity($id)
    {
        $item = Cart::find($id);

        if ($item->quantity > 1) {
            $item->quantity -= 1;
            $item->save();
        }

        $this->cart = Cart::with('product')->get();
        $this->updateTotal();
    }

    public function updateTotal()
    {
        $this->total = $this->cart
            ->whereIn('id', $this->selectedItems)
            ->sum(fn($item) => $item->product->price * $item->quantity);
    }

    public function startCheckout()
    {
        session(['selected_cart_ids' => $this->selectedItems]);
        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
