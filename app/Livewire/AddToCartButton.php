<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class AddToCartButton extends Component
{
    public $productId;

    public function addToCart()
    {
        $product = Product::findOrFail($this->productId);

        // Cegah kalau stok habis
        if ($product->stock < 1) {
            // Bisa pakai session flash atau dispatch event
            session()->flash('error', 'Stok produk habis. Tidak bisa ditambahkan ke keranjang.');
            return;
        }

        // Lanjut tambah ke keranjang
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $this->productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $this->productId,
                'quantity' => 1,
            ]);
        }

        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
