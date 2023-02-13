<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\sppController;

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');




Route::middleware(['auth', 'user-access:siswa'])->group(function () {
  
    Route::get('/siswa/home', [App\Http\Controllers\HomeController::class, 'index'])->name('siswa.home');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home');
});

Route::middleware(['auth', 'user-access:petugas'])->group(function () {
  
    Route::get('/petugas/home', [App\Http\Controllers\HomeController::class, 'petugas'])->name('petugas.home');
});

Route::resource('/siswa', \App\Http\Controllers\SiswaController::class);
Route::resource('/spp', \App\Http\Controllers\sppController::class);