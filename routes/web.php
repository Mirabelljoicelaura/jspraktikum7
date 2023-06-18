<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MahasiswaController;
use App\Models\Article;
use App\Models\Mahasiswa;
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
Route::resource('mahasiswas', MahasiswaController::class);
Route::get('/mahasiswas/nilai/{mahasiswa}', [MahasiswaController::class, 'nilai'])->name('mahasiswas.nilai');
Route::resource('articles', ArticleController::class);
Route::get('/article/cetak_pdf',[ArticleController::class,'cetak_pdf']);
// Route::get('/mahasiswas/cetak_pdf',[MahasiswaController::class,'cetak_pdf']);
//  Route::get('/mahasiswa/cetak_pdf', [MahasiswaController::class, 'cetak_pdf'])->name('mahasiswas.cetak_pdf');
Route::get('/mahasiswas/{id}/cetak_pdf', [MahasiswaController::class, 'cetak_pdf'])->name('mahasiswas.cetak_pdf');



