<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookShelfsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('books', 'App\Http\Controllers\BookController');
Route::get('books-export_excel', [BookController::class, 'export_excel'])->name('books.export-excel');
Route::get('books-export_pdf', [BookController::class, 'export_pdf'])->name('books.export-pdf');
Route::post('books-import_excel', [BookController::class, 'import_excel'])->name('books.import-excel');

Route::resource('bookshelfs', 'App\Http\Controllers\BookShelfsController');
Route::post('bookshelfs-import_excel', [BookShelfsController::class, 'import_excel'])->name('book-shelfs.import-excel');
Route::get('bookshelfs-export_excel', [BookShelfsController::class, 'export_excel'])->name('book-shelfs.export-excel');
Route::get('bookshelfs-export_pdf', [BookShelfsController::class, 'export_pdf'])->name('book-shelfs.export-pdf');

require __DIR__.'/auth.php';
