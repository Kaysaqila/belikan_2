<?php

use App\Models\Product;
use App\Models\Category;
use App\Livewire\ProductCategory;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Livewire\CartComponent;
use App\Livewire\Checkout\CheckoutComponent;
use App\Livewire\Jenis\ShowJenis;

Route::get('/', function () {
    $categories = Category::with('products')->get();
    return view('welcome', compact('categories'));
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth'])->group(function () {
    
    Route::get('reset-password/{token}', [HomeController::class, 'resetPassword'])
        ->name('password.reset');

    Route::post('reset-password/{token}', [HomeController::class, 'updatePassword'])
        ->name('password.update');

    Route::post('forgot-password', [HomeController::class, 'emailResetPassword'])
        ->name('password.email');

    Route::get('/dashboard', function () {
        $topProducts = Product::with('category')->orderBy('stock', 'asc')->take(8)->get();
        return view('dashboard', compact('topProducts'));
    })->name('dashboard');

    Route::get('/jenis',App\Livewire\Jenis\Index::class)->name('jenis.index');
    Route::get('/jenis/{id}', ShowJenis::class)->name('jenis.show');
    Route::get('/aquarium',App\Livewire\Aquarium\Index::class)->name('aquarium.index');
    Route::get('/perawatan',App\Livewire\Perawatan\Index::class)->name('perawatan.index');
    Route::get('/aksesoris',App\Livewire\Aksesoris\Index::class)->name('aksesoris.index');
    Route::get('/perawatan',App\Livewire\Perawatan\Index::class)->name('perawatan.index');
    Route::get('/cart', App\Livewire\CartComponent::class)->name('cart.index');
    Route::get('/checkout', CheckoutComponent::class)->name('checkout');
    Route::get('/checkout/success', App\Livewire\Checkout\SuccessComponent::class)->name('checkout.success');
    Route::get('/jenis/{categoryJenis}', App\Livewire\Jenis\Index::class);
    
    // Route::get('/product/{id}', App\Livewire\Jenis\Index::class)->name('product.show'); 
    // INII SALAH karena kan kalau mau ngembaliin views tuh path nya bukan ke App\Livewire.... tapi langsung ke return view (secara default udh kesini)
    Route::get('/product/jenis/{id}', function ($id) {
        $product = Product::with('category')->findOrFail($id);
        return view('livewire.jenis.show', compact('product'));
    })->name('jenis.show');
    
    Route::get('/aquarium/{id}', function ($id) {
        $product = Product::with('category')->findOrFail($id);
        return view('livewire.aquarium.show', compact('product'));
    })->name('aquarium.show');

    Route::get('/perawatan/{id}', function ($id) {
        $product = Product::with('category')->findOrFail($id);
        return view('livewire.perawatan.show', compact('product'));
    })->name('perawatan.show');

    Route::get('/aksesoris/{id}', function ($id) {
        $product = Product::with('category')->findOrFail($id);
        return view('livewire.aksesoris.show', compact('product'));
    })->name('aksesoris.show');
});

