
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\GastosVeiculoController;
use App\Http\Controllers\FluxoDeCaixaController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::resource('clientes', ClienteController::class);
    Route::resource('veiculos', VeiculoController::class);
    Route::resource('empresas', EmpresaController::class);
    Route::resource('fornecedores', FornecedorController::class);
    Route::resource('compras', CompraController::class);
    Route::resource('vendas', VendaController::class);
    Route::resource('documentos', DocumentoController::class);
    Route::resource('gastos-veiculos', GastosVeiculoController::class);
    Route::resource('fluxo-de-caixa', FluxoDeCaixaController::class);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes();
