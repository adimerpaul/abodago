<?php

use Illuminate\Http\Request;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('/login',[\App\Http\Controllers\UserController::class,'login']);
Route::post('/register',[\App\Http\Controllers\UserController::class,'register']);
Route::resource('/unit',\App\Http\Controllers\UnitController::class);
Route::group(['middleware'=>'auth:sanctum'],function (){
    Route::post('/logout',[\App\Http\Controllers\UserController::class,'logout']);
    Route::post('/me',[\App\Http\Controllers\UserController::class,'me']);
    Route::put('/pass/{user}',[\App\Http\Controllers\UserController::class,'pass']);
    Route::put('/updatepermisos/{user}',[\App\Http\Controllers\UserController::class,'updatepermisos']);
    Route::resource('/user',\App\Http\Controllers\UserController::class);
    Route::resource('/asignacion',\App\Http\Controllers\AsignacionController::class);
    Route::post('/misremetentes',[\App\Http\Controllers\UserController::class,'misremetentes']);
    Route::post('/usuarios',[\App\Http\Controllers\UserController::class,'usuarios']);
    Route::post('/regreso/{id}',[\App\Http\Controllers\ClienteController::class,'regreso']);
    Route::post('/ringreso/{id}',[\App\Http\Controllers\ClienteController::class,'ringreso']);
    Route::post('/impresion/{id}',[\App\Http\Controllers\DespachoController::class,'impresion']);
    Route::resource('/permiso',\App\Http\Controllers\PermisoController::class);

    Route::resource('/despacho',\App\Http\Controllers\DespachoController::class);
    Route::resource('/cliente',\App\Http\Controllers\ClienteController::class);
    Route::resource('/tramite',\App\Http\Controllers\TramiteController::class);
    Route::resource('/ingreso',\App\Http\Controllers\IngresoController::class);
    Route::resource('/egreso',\App\Http\Controllers\EgresoController::class);
    Route::resource('/requisitos',\App\Http\Controllers\RequisitoController::class);
    Route::resource('/empleado',\App\Http\Controllers\EmpleadoController::class);
    Route::resource('/sueldo',\App\Http\Controllers\SueldoController::class);
    
});

