<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\EncargadoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')->middleware(['auth'])->name('profile');
Route::get('/marca', [MarcaController::class, 'index'])->middleware(['auth'])->name('marca.index');
Route::get('/marca/pdf', [MarcaController::class, 'pdf'])->middleware(['auth'])->name('marca.pdf');
Route::get('/persona', [PersonaController::class, 'index'])->middleware(['auth'])->name('persona.index');
Route::get('/persona/pdf', [PersonaController::class, 'pdf'])->middleware(['auth'])->name('persona.pdf');
Route::get('/encargado', [EncargadoController::class, 'index'])->middleware(['auth'])->name('encargado.index');
Route::get('/encargado/pdf', [EncargadoController::class, 'pdf'])->middleware(['auth'])->name('encargado.pdf');
Route::get('/equipo', [EquipoController::class, 'index'])->middleware(['auth'])->name('equipo.index');
Route::get('/equipo/{slug}', [EquipoController::class, 'show'])->middleware(['auth'])->name('equipo.show');
Route::get('/equipo/pdf', [EquipoController::class, 'pdf'])->middleware(['auth'])->name('equipo.pdf');
Route::get('/componente', [ComponenteController::class, 'index'])->middleware(['auth'])->name('componente.index');
Route::get('/componente/pdf', [ComponenteController::class, 'pdf'])->middleware(['auth'])->name('componente.pdf');

Route::get('/categoria', [CategoriaController::class, 'index'])->middleware(['auth'])->name('categoria.index');
Route::get('/noticia', [NoticiaController::class, 'index'])->middleware(['auth'])->name('noticia.index');

Route::get('/usuario', [UsuarioController::class, 'index'])->middleware(['auth'])->name('usuario.index');
Route::get('/rol', [RolController::class, 'index'])->middleware(['auth'])->name('rol.index');


require __DIR__.'/auth.php';
