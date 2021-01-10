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
Route::get('/movies', [MoviesController::class, 'getAll'])->name('getAll');
Route::get('/movies/{id}', [MoviesController::class, 'getById'])->name('getById');
Route::post('/movies', [MoviesController::class, 'creat'])->name('creat');
Route::put('/movies/{id}', [MoviesController::class, 'edit'])->name('edit');
Route::delete('/movies/{id}', [MoviesController::class, 'delete'])->name('delete');

# Ratings
Route::get('/ratings', [ReviewsController::class, 'getAll'])->name('getAll');
Route::get('/ratings/{id}', [ReviewsController::class, 'getById'])->name('getById');
Route::post('/ratings', [ReviewsController::class, 'creat'])->name('creat');
Route::put('/ratings/{id}', [ReviewsController::class, 'edit'])->name('edit');
Route::delete('/ratings/{id}', [ReviewsController::class, 'delete'])->name('delete');
