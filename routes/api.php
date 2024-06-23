<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\RecursoController; // Asegúrate de importar RecursoController
use App\Http\Controllers\UserController;
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
Route::post('/user', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/toda', function (Request $request) {
    return "hola";
});
Route::get('/quiz', [QuizController::class, 'quiz_ajax']);
Route::post('/crudquiz', [QuizController::class, 'crudquiz']);
Route::get('/quiz/{id}', [QuizController::class, 'detalle_quiz']);
Route::post('/quiz/responses', [QuizController::class, 'store']);

Route::get('/recurso', [RecursoController::class, 'recurso_ajax']);
