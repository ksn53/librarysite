<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Books;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;

Route::get('/category/{category}', [CategoryController::class, 'index'])->name('category');
Route::resource('/books', Books::class);
Route::get('/', [MainController::class, 'index'])->name('mainpage');
Route::get('/panel', [AdminController::class, 'index'])->name('adminpanel');
Route::get('/panel/booklist', [AdminController::class, 'booklist'])->name('admin.book.list');
Auth::routes();


