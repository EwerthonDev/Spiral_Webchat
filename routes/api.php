<?php

use App\Http\Controllers\Api\ContatoController;
use App\Http\Controllers\Api\MensagemController;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/contatos', [ContatoController::class, 'index'])->name('contato');
    Route::get('/contatos/{usuario}', [ContatoController::class, 'show'])->name('contato_ativo');
    Route::get('/mensagens/{usuario}', [MensagemController::class, 'listarMensagens'])->name('listar_mensagens');
});