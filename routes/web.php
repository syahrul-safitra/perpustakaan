<?php

use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnggotaController;
use Illuminate\Support\Facades\Route;

use App\Models\book;
use App\Models\Category;

use Carbon\Carbon;

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

Route::get('/', [BorrowController::class, 'dashboard'])->middleware(['auth', 'isAdmin']);

Route::resource('category', CategoryController::class)->middleware(['auth', 'isAdmin']);
Route::resource('book', BookController::class)->middleware('auth');

Route::get('login', [LoginController::class, 'login'])->middleware('guest')->name('login');
Route::post('autentikasi', [LoginController::class, 'autentikasi']);
Route::post('logout', [LoginController::class, 'logout']);

Route::resource('anggota', AnggotaController::class)->middleware(['auth', 'isAdmin']);

Route::get('siswa', function () {

    return view('user.index', [
        'books' => Book::with('category')->filters(request(['search', 'category']))->latest()->get(),
        'categories' => Category::all()
    ]);
})->middleware('auth');

Route::get('cek', function () {
    return dd(auth()->user());
});


// Peminjaman
Route::resource('pinjam', BorrowController::class)->middleware('auth');
Route::post('cetak/peminjaman', [BorrowController::class, 'cetak'])->middleware('auth');
Route::get('peminjaman/{user}', [BorrowController::class, 'peminjaman_user']);
Route::get('profil/{user}', [AnggotaController::class, 'profil'])->middleware('auth');

Route::post('kembalikan/{pinjam}', [Borrowcontroller::class, 'kembalikan']);

Route::get('end', function () {
    return Carbon::now()->format('Y');
});