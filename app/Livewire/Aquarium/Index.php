<?php

namespace App\Livewire\Aquarium;

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
        $categoryAquarium = 'Aquarium'; // Tentukan nama kategori yang dicari
        $productsQuery = Product::whereHas('category', function ($query) use ($categoryAquarium) {
            $query->where('name', $categoryAquarium);
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

        return view('livewire.aquarium.index', [
            'products' => $products,
            'categoryAquarium' => $categoryAquarium,
            'sortBy' => $this->sortBy,
            'cari' => $this->cari,
        ]);
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

    public function mount()
    {
        $this->sortBy = request()->query('sort', 'price_asc');
        $this->cari = request()->query('cari', '');
    }
}
