<?php

namespace App\Livewire\Perawatan;

use Livewire\Component;
use App\Models\Product;

class Index extends Component
{
    public function render()
    {
        $categoryPerawatan = 'Perawatan'; // Tentukan nama kategori yang dicari
        $products = Product::whereHas('category', function ($query) use ($categoryPerawatan) {
            $query->where('name', $categoryPerawatan);
        })->get();

        return view('livewire.perawatan.index', compact('products', 'categoryPerawatan'));
    }

    public function index($categoryPerawatan)
    {
        $products = Product::whereHas('category', function ($query) use ($categoryPerawatan) {
            $query->where('name', $categoryPerawatan); // Pastikan 'name' sesuai dengan kolom di tabel kategori
        })->get();

        return view('index', compact('products', 'categoryPerawatan'));
    }
    
    public function show($id)
    {
        $products = Product::with('category')->findOrFail($id);
        return view('show', compact('product'));
    }
}
