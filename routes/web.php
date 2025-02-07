<?php

use App\Livewire\Products;
use Illuminate\Support\Facades\Route;

Route::get('/', Products::class)
    ->middleware(['auth', 'verified'])
    ->name('products');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
