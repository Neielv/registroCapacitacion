<?php

use App\Http\Livewire\CreatePedido;
use App\Http\Livewire\CreateRegistro;
use App\Http\Livewire\ShowCiudades;
use App\Http\Livewire\ShowClientes;
use App\Http\Livewire\ShowDocumentos;
use App\Http\Livewire\ShowEstanterias;
use App\Http\Livewire\ShowExistencias;
use App\Http\Livewire\ShowProductos;
use App\Http\Livewire\ShowIngresos;
use App\Http\Livewire\ShowTraslados;
use App\Http\Livewire\ShowPedidos;
use App\Http\Livewire\ShowReportes;
use App\Http\Livewire\ShowUsers;
use Illuminate\Support\Facades\Route;

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

Route::get('/registro', CreateRegistro::class)->name('registro');

Route::middleware(['auth:sanctum', 'verified'])->get('/', CreateRegistro::class)->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', ShowProductos::class)->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/bodegas', ShowCiudades::class)->name('bodegas');
Route::middleware(['auth:sanctum', 'verified'])->get('/usuarios', ShowUsers::class)->name('usuarios');
Route::middleware(['auth:sanctum', 'verified'])->get('/ingresos', ShowIngresos::class)->name('ingresos');
Route::middleware(['auth:sanctum', 'verified'])->get('/traslados', ShowTraslados::class)->name('traslados');
Route::middleware(['auth:sanctum', 'verified'])->get('/clientes', ShowClientes::class)->name('clientes');
Route::middleware(['auth:sanctum', 'verified'])->get('/pedidos', ShowPedidos::class)->name('pedidos');
Route::middleware(['auth:sanctum', 'verified'])->get('/pedido', CreatePedido::class)->name('pedido');
Route::middleware(['auth:sanctum', 'verified'])->get('/existencia', ShowExistencias::class)->name('existencia');
Route::middleware(['auth:sanctum', 'verified'])->get('/reportes', ShowReportes::class)->name('reportes');
Route::middleware(['auth:sanctum', 'verified'])->get('/estanterias', ShowEstanterias::class)->name('estanterias');
Route::middleware(['auth:sanctum', 'verified'])->get('/documentos', ShowDocumentos::class)->name('documentos');


