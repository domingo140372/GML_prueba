<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/usuario', function (Request $request) {
    return $request->usuario();
});

Route::apiResource('/usuarios', App\Http\Controllers\UsuariosControllerApi::class)->middleware('api');
Route::apiResource('/paises', App\Http\Controllers\PaisesControllerApi::class)->middleware('api');
Route::apiResource('/categorias', App\Http\Controllers\CategoriasControllerApi::class)->middleware('api');

