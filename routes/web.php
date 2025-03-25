<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/jenis',App\Livewire\Jenis\Index::class)->name('jenis.index');
    Route::get('/aquarium',App\Livewire\Aquarium\Index::class)->name('aquarium.index');
    Route::get('/perawatan',App\Livewire\Perawatan\Index::class)->name('perawatan.index');
    Route::get('/aksesoris',App\Livewire\Aksesoris\Index::class)->name('aksesoris.index');
});