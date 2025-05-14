<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public $cartItems;
    public $total = 0;

    public function mount()
    {
        $this->fetchCart();
    }

    public function fetchCart()
    {
        $this->cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // Hitung total dari semua item
        $this->total = $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->stock < 1) {
            // Bisa kasih notifikasi Livewire toast atau return
            return;
        }

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity < $product->stock) {
                $cartItem->quantity++;
                $cartItem->save();
            }
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

    public function incrementQuantity($cartId)
    {
        $cartItem = Cart::with('product')->find($cartId);

        if ($cartItem && $cartItem->quantity < $cartItem->product->stock) {
            $cartItem->quantity++;
            $cartItem->save();
            $this->fetchCart();
        }
    }

    public function decrementQuantity($cartId)
    {
        $cartItem = Cart::find($cartId);
        if ($cartItem && $cartItem->quantity > 1) {
            $cartItem->quantity--;
            $cartItem->save();
            $this->fetchCart();
        }
    }

}
