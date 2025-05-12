<?php

use App\Http\Controllers\EntrenamientoController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ExerciseLogController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkoutExerciseController;
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
Route::post('/workouts/full', [EntrenamientoController::class, 'storeWithExercises']);


Route::patch('/workouts/{id}', [EntrenamientoController::class, 'update']);
Route::post('/workouts', [EntrenamientoController::class, 'store']);
Route::get('/workouts', [EntrenamientoController::class, 'index']);
Route::get('/workouts/{id}', [EntrenamientoController::class, 'show']);
Route::delete('/workouts/{id}', [EntrenamientoController::class, 'destroy']);
Route::get('/workouts/user/{idUser}',[EntrenamientoController::class,'getWorkoutsByUser']);
Route::get('/workouts/user/{idUser}/type/{type}',[EntrenamientoController::class,'getWorkoutsByUserAndType']);
Route::get('/workouts/user/{idUser}/train/{train}',[EntrenamientoController::class,'getWorkoutsByUserAndTrain']);


// Ejercicios
Route::apiResource('exercises', ExerciseController::class);

// Relación Workout-Ejercicios
Route::apiResource('workout-exercises', WorkoutExerciseController::class);

// Personalizadas
Route::get('/workouts/{workoutId}/exercises', [WorkoutExerciseController::class, 'getExercisesByWorkout']);
Route::get('/exercises/{exerciseId}/workouts', [WorkoutExerciseController::class, 'getWorkoutsByExercise']);


//Logs
Route::get('/workout-exercises/{workout_exercise}/logs', [ExerciseLogController::class, 'index']); 
Route::post('/exercise-log', [ExerciseLogController::class, 'store']);
Route::patch('/exercise-logs/{exercise_log}', [ExerciseLogController::class, 'update']); 
Route::delete('/exercise-logs/{exercise_log}', [ExerciseLogController::class, 'destroy']); 
