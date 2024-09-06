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
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

//rutas de las marcas
Volt::route('/marcas', 'marcas.index')->middleware(['auth'])->name('marcas.index');
Volt::route('/marcas/create', 'marcas.create')->middleware(['auth'])->name('marcas.create');
Volt::route('/marcas/{marca}/edit', 'marcas.edit')->middleware(['auth'])->name('marcas.edit');
Route::get('/marca/pdf', [MarcaController::class, 'pdf'])->middleware(['auth'])->name('marca.pdf');

//rutas de las componentes
Volt::route('/componentes', 'componentes.index')->middleware(['auth'])->name('componentes.index');
Volt::route('/componentes/create', 'componentes.create')->middleware(['auth'])->name('componentes.create');
Volt::route('/componentes/{componente}/edit', 'componentes.edit')->middleware(['auth'])->name('componentes.edit');
Route::get('componente/pdf', [ComponenteController::class, 'pdf'])->middleware(['auth'])->name('componente.pdf');

//rutas de las encargados
Volt::route('/encargados', 'encargados.index')->middleware(['auth'])->name('encargados.index');
Volt::route('/encargados/create', 'encargados.create')->middleware(['auth'])->name('encargados.create');
Volt::route('/encargados/{encargado}/edit', 'encargados.edit')->middleware(['auth'])->name('encargados.edit');
Route::get('encargados/pdf', [ComponenteController::class, 'pdf'])->middleware(['auth'])->name('encargados.pdf');


//rutas de las equipos
Volt::route('/equipos', 'equipos.index')->middleware(['auth'])->name('equipos.index');
Volt::route('/equipos/create', 'equipos.create')->middleware(['auth'])->name('equipos.create');
Volt::route('/equipos/{equipo}/edit', 'equipos.edit')->middleware(['auth'])->name('equipos.edit');
Volt::route('/equipos/{slug}', 'equipos.show')->middleware(['auth'])->name('equipos.show');
Route::get('/equipos/pdf', [EquipoController::class, 'pdf'])->middleware(['auth'])->name('equipos.pdf');


//rutas de las categorias
Volt::route('/categorias', 'categorias.index')->middleware(['auth'])->name('categorias.index');
Volt::route('/categorias/create', 'categorias.create')->middleware(['auth'])->name('categorias.create');
Volt::route('/categorias/{categoria}/edit', 'categorias.edit')->middleware(['auth'])->name('categorias.edit');
Volt::route('/categorias/{slug}', 'categorias.show')->middleware(['auth'])->name('categorias.show');

//rutas de las noticias
Volt::route('/noticias', 'noticias.index')->middleware(['auth'])->name('noticias.index');
Volt::route('/noticias/create', 'noticias.create')->middleware(['auth'])->name('noticias.create');
Volt::route('/noticias/{noticia}/edit', 'noticias.edit')->middleware(['auth'])->name('noticias.edit');
Volt::route('/noticias/{slug}', 'noticias.show')->middleware(['auth'])->name('noticias.show');

Route::get('/usuario', [UsuarioController::class, 'index'])->middleware(['auth'])->name('usuario.index');
Route::get('/rol', [RolController::class, 'index'])->middleware(['auth'])->name('rol.index');


require __DIR__.'/auth.php';
