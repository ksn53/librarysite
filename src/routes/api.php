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

use App\Http\Controllers\api\RegisterController;
use App\Http\Controllers\api\BookController;

Route::controller(RegisterController::class)->group(function(){
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::get('books', [BookController::class, 'index'])->name('api.books.index');
    Route::get('books/{id}', [BookController::class, 'getBook'])->name('api.books.show');
    Route::post('books', [BookController::class, 'createBook'])->name('api.books.create');
    Route::put('books/{id}', [BookController::class, 'updateBook'])->name('api.books.update');
    Route::delete('books/{id}', [BookController::class, 'deleteBook'])->name('api.books.delete');
});
