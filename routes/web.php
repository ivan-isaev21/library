<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\Library\LibraryController::class, 'index'])->name('home');
Route::get('/books/{book}/edit', [\App\Http\Controllers\Library\LibraryController::class, 'edit'])->name('books.edit');
Route::get('/books/create', [\App\Http\Controllers\Library\LibraryController::class, 'create'])->name('books.create');

Route::get('/publishers', [\App\Http\Controllers\Library\PublisherController::class, 'index'])->name('publishers.index');
Route::get('/publishers/{publisher}/edit', [\App\Http\Controllers\Library\PublisherController::class, 'edit'])->name('publishers.edit');
Route::get('/publishers/create', [\App\Http\Controllers\Library\PublisherController::class, 'create'])->name('publishers.create');

Auth::routes();


