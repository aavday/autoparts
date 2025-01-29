<?php

use App\Livewire\Products;
use Illuminate\Support\Facades\Route;

Route::get('/', Products::class);
Route::view('/welcome','welcome');

require __DIR__.'/auth.php';
