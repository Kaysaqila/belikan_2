<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public $cartItems;

    public function mount()
    {
        $this->fetchCart();
    }

    public function fetchCart()
    {
        $this->cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();
    }

    public function addToCart($productId)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => 1,
                'added_at' => now(),
            ]);
        }

        $this->fetchCart();
    }

    public function removeFromCart($cartId)
    {
        Cart::where('id', $cartId)->delete();
        $this->fetchCart();
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
