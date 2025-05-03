<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductCategory extends Component
{
    public $category;
    public $product = [] ;

    public function mount($category)
    {
        $this->category = $category;
        $this->product = Product::where('category', $category)->get();
    }

    public function render()
    {
        return view('livewire.product-category', [
            'product' => $this->product,
        ]);
    }
}
