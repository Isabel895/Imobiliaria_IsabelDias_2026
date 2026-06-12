<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ApartamentoController;
use App\Http\Controllers\VendaController;

Route::get('/', fn() => redirect()->route('clientes.index'));

// Rotas que requerem autenticação (create, store, edit, update, destroy)
Route::middleware('auth')->group(function () {
    Route::resource('clientes',     ClienteController::class)->except(['index', 'show']);
    Route::resource('apartamentos', ApartamentoController::class)->except(['index', 'show']);
    Route::resource('vendas',       VendaController::class)->except(['index', 'show']);
});

// Rotas públicas (index e show) — declaradas DEPOIS das rotas create/edit
// para evitar que {cliente} capture "create" ou "edit"
Route::get('/clientes',                    [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/{cliente}',          [ClienteController::class, 'show'])->name('clientes.show');
Route::get('/apartamentos',                [ApartamentoController::class, 'index'])->name('apartamentos.index');
Route::get('/apartamentos/{apartamento}',  [ApartamentoController::class, 'show'])->name('apartamentos.show');
Route::get('/vendas',                      [VendaController::class, 'index'])->name('vendas.index');
Route::get('/vendas/{venda}',              [VendaController::class, 'show'])->name('vendas.show');

require __DIR__.'/auth.php';
