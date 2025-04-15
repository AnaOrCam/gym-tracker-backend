<?php

use App\Http\Controllers\EntrenamientoController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Rutas usuarios
Route::patch('/users/{id}', [UserController::class, 'update']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::post('/login', [UserController::class, 'login']);

//Contraseña olvidada
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [ResetPasswordController::class, 'reset']);


//Rutas entrenamientos
Route::patch('/workouts/{id}', [EntrenamientoController::class, 'update']);
Route::post('/workouts', [EntrenamientoController::class, 'store']);
Route::get('/workouts', [EntrenamientoController::class, 'index']);
Route::get('/workouts/{id}', [EntrenamientoController::class, 'show']);
Route::delete('/workouts/{id}', [EntrenamientoController::class, 'destroy']);
Route::get('/workouts/user/{idUser}',[EntrenamientoController::class,'getWorkoutsByUser']);
Route::get('/workouts/user/{idUser}/type/{type}',[EntrenamientoController::class,'getWorkoutsByUserAndType']);
Route::get('/workouts/user/{idUser}/train/{train}',[EntrenamientoController::class,'getWorkoutsByUserAndTrain']);

