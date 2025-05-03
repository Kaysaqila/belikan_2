<?php

namespace App\Livewire\Jenis;

use Livewire\Component;
use App\Models\Product;

class Index extends Component
{
   
    public function render()
    {
        $categoryJenis = 'Jenis'; // Tentukan nama kategori yang dicari
        $products = Product::whereHas('category', function ($query) use ($categoryJenis) {
            $query->where('name', $categoryJenis);
        })->get();

        return view('livewire.jenis.index', compact('products', 'categoryJenis'));
    }

    public function index($categoryJenis)
    {
        $products = Product::whereHas('category', function ($query) use ($categoryJenis) {
            $query->where('name', $categoryJenis); // Pastikan 'name' sesuai dengan kolom di tabel kategori
        })->get();

        return view('index', compact('products', 'categoryJenis'));
    }

    public function show($id)
    {
        $products = Product::with('category')->findOrFail($id);
        return view('show', compact('product'));
    }
}
