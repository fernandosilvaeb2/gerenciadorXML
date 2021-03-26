<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadServer;
use App\Http\Controllers\StoreServer;
use App\Http\Controllers\NotaFiscalController;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notas', [NotaFiscalController::class, 'index']);
Route::get('/notas/{nf}', [NotaFiscalController::class, 'show']);

Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/clientes/{id}', [ClienteController::class, 'show']);

Route::post('/uploadxml', UploadServer::class);
Route::post('/salvarxml', StoreServer::class);
