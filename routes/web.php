<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::post('/books/{book}/borrow', [BookController::class, 'borrow'])->name('books.borrow');
Route::post('/books/{book}/return', [BookController::class, 'returnBook'])->name('books.return');
