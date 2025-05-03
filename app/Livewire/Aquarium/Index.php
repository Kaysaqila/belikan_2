<?php

namespace App\Livewire\Aquarium;

use Livewire\Component;
use App\Models\Product;

class Index extends Component
{
    public function render()
    {
        $categoryAquarium = 'Aquarium'; // Tentukan nama kategori yang dicari
        $products = Product::whereHas('category', function ($query) use ($categoryAquarium) {
            $query->where('name', $categoryAquarium);
        })->get();

        return view('livewire.aquarium.index', compact('products', 'categoryAquarium'));
    }

    public function index($categoryAquarium)
    {
        $products = Product::whereHas('category', function ($query) use ($categoryAquarium) {
            $query->where('name', $categoryAquarium); // Pastikan 'name' sesuai dengan kolom di tabel kategori
        })->get();

        return view('index', compact('products', 'categoryAquarium'));
    }

    public function show($id)
    {
        $products = Product::with('category')->findOrFail($id);
        return view('show', compact('product'));
    }
}
