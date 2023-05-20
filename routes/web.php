<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Usuario\Create as UsuarioCreate;
use App\Http\Livewire\Usuario\Index as UsuarioIndex;
use App\Http\Livewire\Usuario\Edit as UsuarioEdit;

use App\Http\Livewire\RolUsuario\Index as RolUsuarioIndex;
use App\Http\Livewire\RolUsuario\Edit as RolUsuarioEdit;
use App\Http\Livewire\RolUsuario\Create as RolUsuarioCreate;

use App\Http\Livewire\PermisoRol\Index as PermisoRolIndex;
use App\Http\Livewire\PermisoRol\Edit as PermisoRolEdit;
use App\Http\Livewire\PermisoRol\Create as PermisoRolCreate;

use App\Http\Livewire\Modulo\Index as ModuloIndex;
use App\Http\Livewire\Modulo\Edit as ModuloEdit;
use App\Http\Livewire\Modulo\Create as ModuloCreate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
      //Walmart: usuarios
      Route::get('/usuarios', UsuarioIndex::class)->name('usuarios.index');
      Route::get('/usuarios/nuevo', UsuarioCreate::class)->name('usuarios.nuevo');
      Route::get('/usuarios/editar/{id}', UsuarioEdit::class)->name('usuarios.editar');

      //Walmart: rol usuario
      Route::get('/roles', RolUsuarioIndex::class)->name('roles.index');
      Route::get('/roles/nuevo', RolUsuarioCreate::class)->name('roles.nuevo');
      Route::get('/roles/editar/{id}', RolUsuarioEdit::class)->name('roles.editar');

      //Walmart: rol permisos
      Route::get('/roles/permisos', PermisoRolIndex::class)->name('permisos.index');
      Route::get('/roles/permisos/nuevo', PermisoRolCreate::class)->name('permisos.nuevo');
      Route::get('/roles/permisos/editar/{id}', PermisoRolEdit::class)->name('permisos.editar');

      //Walmart: administrador de modulos
      Route::get('/modulos', ModuloIndex::class)->name('modulos.index');
      Route::get('/modulos/registrar', ModuloCreate::class)->name('modulos.nuevo');
      Route::get('/modulos/editar/{id}', ModuloEdit::class)->name('modulos.editar');
  });