<?php

use App\Http\Controllers\RecoleccionAlimentosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BancoAlimentosController;
use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\CadenaComercialController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\AlimentoController;
use App\Http\Controllers\CategoriaAlimentoController;
use App\Http\Controllers\RecoleccionController;
//Import AuthController
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('municipio')->group(function(){
    Route::get('index', [MunicipioController::class, 'index']);
    Route::post('store', [MunicipioController::class, 'store']);
    Route::put('update/{id}', [MunicipioController::class, 'update']);
    Route::get('show/{id}', [MunicipioController::class, 'show']);
    Route::delete('destroy/{id}', [MunicipioController::class, 'destroy']);
});

Route::prefix('usuario')->group(function(){
    Route::get('index', [UsuarioController::class, 'index']);
    Route::post('store', [UsuarioController::class, 'store']);
    Route::put('update/{id}', [UsuarioController::class, 'update']);
    Route::get('show/{id}', [UsuarioController::class, 'show']);
    Route::delete('destroy/{id}', [UsuarioController::class, 'destroy']);
});

Route::prefix('bancoAlimentos')->group(function(){
    Route::get('index', [BancoAlimentosController::class, 'index']);
    Route::post('store', [BancoAlimentosController::class, 'store']);
    Route::put('update/{id}', [BancoAlimentosController::class, 'update']);
    Route::get('show/{id}', [BancoAlimentosController::class, 'show']);
    Route::delete('destroy/{id}', [BancoAlimentosController::class, 'destroy']);
});

Route::prefix('convenio')->group(function(){
    Route::get('index', [ConvenioController::class, 'index']);
    Route::post('store', [ConvenioController::class, 'store']);
    Route::put('update/{id}', [ConvenioController::class, 'update']);
    Route::get('show/{id}', [ConvenioController::class, 'show']);
    Route::delete('destroy/{id}', [ConvenioController::class, 'destroy']);
});

Route::prefix('cadenaComercial')->group(function(){
    Route::get('index', [CadenaComercialController::class, 'index']);
    Route::post('store', [CadenaComercialController::class, 'store']);
    Route::put('update/{id}', [CadenaComercialController::class, 'update']);
    Route::get('show/{id}', [CadenaComercialController::class, 'show']);
    Route::delete('destroy/{id}', [CadenaComercialController::class, 'destroy']);
});

Route::prefix('almacen')->group(function(){
    Route::get('index', [AlmacenController::class, 'index']);
    Route::post('store', [AlmacenController::class, 'store']);
    Route::put('update/{id}', [AlmacenController::class, 'update']);
    Route::get('show/{id}', [AlmacenController::class, 'show']);
    Route::delete('destroy/{id}', [AlmacenController::class, 'destroy']);
    Route::get('alimentos/{id}', [AlmacenController::class, 'alimentosAlmacen']);
});

Route::prefix('alimento')->group(function(){
    Route::get('index', [AlimentoController::class, 'index']);
    Route::post('store', [AlimentoController::class, 'store']);
    Route::put('update/{id}', [AlimentoController::class, 'update']);
    Route::get('show/{id}', [AlimentoController::class, 'show']);
    Route::delete('destroy/{id}', [AlimentoController::class, 'destroy']);
});

Route::prefix('categoriaAlimento')->group(function(){
    Route::get('index', [CategoriaAlimentoController::class, 'index']);
    Route::post('store', [CategoriaAlimentoController::class, 'store']);
    Route::put('update/{id}', [CategoriaAlimentoController::class, 'update']);
    Route::get('show/{id}', [CategoriaAlimentoController::class, 'show']);
    Route::delete('destroy/{id}', [CategoriaAlimentoController::class, 'destroy']);
});

Route::prefix('recoleccion')->group(function(){
    Route::get('index', [RecoleccionController::class, 'index']);
    Route::post('store', [RecoleccionController::class, 'store']);
    Route::put('update/{id}', [RecoleccionController::class, 'update']);
    Route::get('show/{id}', [RecoleccionController::class, 'show']);
    Route::delete('destroy/{id}', [RecoleccionController::class, 'destroy']);
    Route::get('detalles/{id}', [RecoleccionController::class, 'origenDestino']);
});

Route::prefix('recoleccion_alimentos')->group(function() {
    Route::get('index', [RecoleccionAlimentosController::class, 'index']);
    Route::post('store', [RecoleccionAlimentosController::class, 'store']);
    Route::put('update', [RecoleccionAlimentosController::class, 'update']);
    Route::get('show/{id}', [RecoleccionAlimentosController::class, 'show']);
});

//Authentication is not required for these endpoints
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//Authentication is required for these endpoints (apply middleware auth:sanctum)
Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::get('userProfile', [AuthController::class, 'userProfile']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('recolecciones-usuario', [RecoleccionController::class, 'recoleccionesUsuario']);
    Route::get('actualizar-estatus-recoleccion/{id}', [RecoleccionController::class, 'updateStatus']);
    Route::get('recolectados/{id}', [RecoleccionAlimentosController::class, 'alimentosRecolectados']);
});

