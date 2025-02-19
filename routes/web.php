<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RelatoriosConroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::view('/', 'welcome');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

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

Route::view('logs', 'logs')
    ->middleware(['auth', 'verified'])
    ->name('logs');

Route::view('relatorios', 'relatorios')
    ->middleware(['auth', 'verified'])
    ->name('relatorios');

Route::get('/relatorios/export/{tipo}', [RelatoriosConroller::class, 'export'])->name('relatorios.export');
Route::get('/relatorios/export/{tipo}/{filtros}', [RelatoriosConroller::class, 'exportComFiltros'])->name('relatorios.export.filtros');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
