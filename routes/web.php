<?php

use App\Http\Controllers\BatasWaktuPeminjamanController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuKunjunganController;
use App\Http\Controllers\EbookController;

use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;

use App\Models\book;
use App\Models\Category;
use App\Models\Ebook;

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|:
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BorrowController::class, 'dashboard'])->middleware(['auth', 'isMaster']);

Route::resource('category', CategoryController::class)->middleware(['auth', 'isAdmin']);
Route::resource('book', BookController::class)->middleware(['auth', 'isMaster']);

Route::post('cetak/book', [BookController::class, 'cetak'])->middleware(['auth', 'isMaster']);


Route::get('login', [LoginController::class, 'login'])->middleware('guest')->name('login');
Route::post('autentikasi', [LoginController::class, 'autentikasi']);
Route::post('logout', [LoginController::class, 'logout']);

Route::resource('anggota', AnggotaController::class)->middleware(['auth', 'isAdmin']);
Route::post('cetak/anggota', [AnggotaController::class, 'cetak'])->middleware('auth', 'isAdmin');


Route::get('admin', [AnggotaController::class, 'editAdmin'])->middleware(['auth', 'isAdmin']);
Route::post('admin/{user}', [AnggotaController::class, 'updateAdmin'])->middleware(['auth', 'isAdmin']);

Route::get('kepsek/{id}', [AnggotaController::class, 'editKepsek'])->middleware(['auth', 'isAdmin']);
Route::post('kepsek/{user}', [AnggotaController::class, 'updateKepsek'])->middleware(['auth', 'isAdmin']);

Route::get('kepperpus/{id}', [AnggotaController::class, 'editKeperpus'])->middleware(['auth', 'isAdmin']);
Route::post('kepperpus/{user}', [AnggotaController::class, 'updateKeperpus'])->middleware(['auth', 'isAdmin']);

// Peminjaman :
Route::resource('pinjam', BorrowController::class)->middleware(['auth', 'isMaster']);
Route::post('cetak/peminjaman', [BorrowController::class, 'cetak']);
Route::post('pinjam_buku', [BorrowController::class, 'store'])->middleware('auth');

Route::get('editpassword/{user}', [AnggotaController::class, 'editpassword'])->middleware('auth');
Route::post('changepassword/{user}', [AnggotaController::class, 'changePassword'])->middleware('auth');

// Siswa :
Route::middleware(['isSiswa', 'isSiswa'])->group(function () {

    Route::get('siswa', function () {

        return view('user.index', [
            'books' => Book::with('category')->filters(request(['search', 'category']))->latest()->get(),
            'categories' => Category::all()
        ]);
    });

    Route::get('siswa/ebook', function () {
        return view('user.ebook', [
            'ebooks' => Ebook::with('category')->filters(request(['search', 'category']))->latest()->get(),
            'categories' => Category::all()
        ]);
    });

    Route::get('peminjaman/{user}', [BorrowController::class, 'peminjaman_user']);
    Route::get('profil/{user}', [AnggotaController::class, 'profil']);

    Route::get('baca/{book}', [BookController::class, 'baca']);
    Route::get('siswa/book/{book}', [BookController::class, 'show']);

    Route::post('kembalikan/{pinjam}', [Borrowcontroller::class, 'kembalikan']);


});

Route::get('end', function () {
    return Carbon::now()->format('Y');
});

Route::post('changebataswaktu', [BatasWaktuPeminjamanController::class, 'update'])->middleware('isAdmin');


// Ressource Ebook : 
Route::resource('ebook', EbookController::class)->middleware(['auth']);
Route::post('cetak/ebook', [EbookController::class, 'cetak'])->middleware('auth');



// NOTE : kunjungan 
Route::resource('kunjungan', BukuKunjunganController::class);
Route::post('cetak/kunjungan', [BukuKunjunganController::class, 'cetak']);

// NOTE : petugas
Route::resource('petugas', PetugasController::class);

// NOTE : Ganti password : 
Route::post('password', [BookController::class, 'changePassword'])->middleware(['auth', 'isAdmin']);