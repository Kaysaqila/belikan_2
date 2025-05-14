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
                //'added_at' => now(),
            ]);
        }

        // Emit ke parent atau komponen lain
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
