<?php

use App\Http\Controllers\Api\MoviesController;
use App\Http\Controllers\Api\ReviewsController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

# Movies
Route::get('/movie/index', [MoviesController::class, 'index'])->name('Listar todos os filmes');
Route::get('/movie/show/{id}', [MoviesController::class, 'show'])->name('Listar filme pelo id');
Route::post('/movie/store', [MoviesController::class, 'store'])->name('Cadastrar um novo filme');
Route::put('/movie/edit/{id}', [MoviesController::class, 'edit'])->name('Atualizar filme pelo id');
Route::delete('/movie/destroy/{id}', [MoviesController::class, 'destroy'])->name('Deletar filme pelo id');

# Ratings
Route::get('/rating/index', [ReviewsController::class, 'index'])->name('Listar todos as avaliações');
Route::get('/rating/show/{id}', [ReviewsController::class, 'show'])->name('Listar avaliação pelo id');
Route::post('/rating/store', [ReviewsController::class, 'store'])->name('Cadastrar uma nova avaliação');
Route::put('/rating/edit/{id}', [ReviewsController::class, 'edit'])->name('Atualizar avaliação pelo id');
Route::delete('/rating/destroy/{id}', [ReviewsController::class, 'destroy'])->name('Deletar avaliação pelo id');
