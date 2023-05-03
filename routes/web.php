<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('mahasiswa', MahasiswaController::class);

Route::get('/mahasiswa/nilai/{Nim}', [App\Http\Controllers\MahasiswaNilaiController::class, 'index'])->name('nilai');

Route::resource('articles', ArticleController::class);

Route::get('/article/cetak_pdf', [App\Http\Controllers\ArticleController::class, 'cetak_pdf']);