<?php

use App\Livewire\Cart;
use App\Livewire\Products;
use Illuminate\Support\Facades\Route;

Route::get('/', Products::class)
    ->middleware(['auth', 'verified'])
    ->name('products');

Route::get('/cart', Cart::class)
    ->middleware(['auth', 'verified'])
    ->name('cart');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
