<?php

namespace App\Livewire\Aksesoris;

use Livewire\Component;
use App\Models\Product;

class Index extends Component
{
    public function render()
    {
        $categoryAksesoris = 'Aksesoris'; // Tentukan nama kategori yang dicari
        $products = Product::whereHas('category', function ($query) use ($categoryAksesoris) {
            $query->where('name', $categoryAksesoris);
        })->get();

        return view('livewire.aksesoris.index', compact('products', 'categoryAksesoris'));
    }

    public function index($categoryAksesoris)
    {
        $products = Product::whereHas('category', function ($query) use ($categoryAksesoris) {
            $query->where('name', $categoryAksesoris); // Pastikan 'name' sesuai dengan kolom di tabel kategori
        })->get();

        return view('index', compact('products', 'categoryAksesoris'));
    }
    
    public function show($id)
    {
        $products = Product::with('category')->findOrFail($id);
        return view('show', compact('product'));
    }
}
