<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('grupos', 'grupos')
    ->middleware(['auth', 'verified'])
    ->name('grupos');

Route::view('bandeiras', 'bandeiras')
    ->middleware(['auth', 'verified'])
    ->name('bandeiras');

Route::view('unidadees', 'unidades')
    ->middleware(['auth', 'verified'])
    ->name('unidades');

Route::view('colaboradores', 'colaboradores')
    ->middleware(['auth', 'verified'])
    ->name('colaboradores');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
