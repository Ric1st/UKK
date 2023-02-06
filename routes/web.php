<?php

use App\Http\Controllers\HomeController;
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

Route::middleware(['auth', 'user-access:pelajar'])->group(function () {
  
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home');
});

Route::middleware(['auth', 'user-access:guru'])->group(function () {
  
    Route::get('/guru/home', [App\Http\Controllers\HomeController::class, 'guru'])->name('guru.home');
});

//Pelajar//
Route::get('/pelajar', [App\Http\Controllers\pelajarController::class, 'index'])->name('DataPelajar');