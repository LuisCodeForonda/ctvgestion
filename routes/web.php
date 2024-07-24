<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/marca', [MarcaController::class, 'index'])->middleware(['auth'])->name('marca.index');
Route::get('/marca/pdf', [MarcaController::class, 'pdf'])->middleware(['auth'])->name('marca.pdf');
Route::get('/persona', [PersonaController::class, 'index'])->middleware(['auth'])->name('persona.index');
Route::get('/persona/pdf', [PersonaController::class, 'pdf'])->middleware(['auth'])->name('persona.pdf');
Route::get('/equipo', [EquipoController::class, 'index'])->middleware(['auth'])->name('equipo.index');
Route::get('/equipo/{slug}', [EquipoController::class, 'show'])->middleware(['auth'])->name('equipo.show');
Route::get('/equipo/pdf', [EquipoController::class, 'pdf'])->middleware(['auth'])->name('equipo.pdf');

Route::get('/usuario', [UsuarioController::class, 'index'])->middleware(['auth'])->name('usuario.index');
Route::get('/rol', [RolController::class, 'index'])->middleware(['auth'])->name('rol.index');


require __DIR__.'/auth.php';