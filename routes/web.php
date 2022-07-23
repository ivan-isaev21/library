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

Route::get('/', [\App\Http\Controllers\Library\LibraryController::class, 'home'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/books', [\App\Http\Controllers\Library\LibraryController::class, 'index'])->name('web.books.index');
    Route::get('/books/{book}/edit', [\App\Http\Controllers\Library\LibraryController::class, 'edit'])->name('web.books.edit');
    Route::get('/books/create', [\App\Http\Controllers\Library\LibraryController::class, 'create'])->name('web.books.create');

    Route::get('/publishers', [\App\Http\Controllers\Library\PublisherController::class, 'index'])->name('web.publishers.index');
    Route::get('/publishers/{publisher}/edit', [\App\Http\Controllers\Library\PublisherController::class, 'edit'])->name('web.publishers.edit');
    Route::get('/publishers/create', [\App\Http\Controllers\Library\PublisherController::class, 'create'])->name('web.publishers.create');

    Route::get('/authors', [\App\Http\Controllers\Library\AuthorController::class, 'index'])->name('web.authors.index');
    Route::get('/authors/{author}/edit', [\App\Http\Controllers\Library\AuthorController::class, 'edit'])->name('web.authors.edit');
    Route::get('/authors/create', [\App\Http\Controllers\Library\AuthorController::class, 'create'])->name('web.authors.create');
});

Auth::routes();
