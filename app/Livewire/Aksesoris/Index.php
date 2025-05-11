<?php

namespace App\Livewire\Aksesoris;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $sortBy = 'price_asc';
    public $cari = '';

    public function render()
    {
        $categoryAksesoris = 'Aksesoris'; // Tentukan nama kategori yang dicari
        $productsQuery = Product::whereHas('category', function ($query) use ($categoryAksesoris) {
            $query->where('name', $categoryAksesoris);
        });

        if (!empty($this->cari)) {
            $productsQuery->where('name', 'like', '%' . $this->cari . '%');
        }

        if ($this->sortBy === 'price_asc') {
            $productsQuery->orderBy('price', 'asc');
        } elseif ($this->sortBy === 'price_desc') {
            $productsQuery->orderBy('price', 'desc');
        }

        $products = $productsQuery->paginate(8); // pagination

        return view('livewire.aksesoris.index', [
            'products' => $products,
            'categoryAksesoris' => $categoryAksesoris,
            'sortBy' => $this->sortBy,
            'cari' => $this->cari,
        ]);
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

    public function mount()
    {
        $this->sortBy = request()->query('sort', 'price_asc');
        $this->cari = request()->query('cari', '');
    }
}
