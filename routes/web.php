<?php

use App\Http\Controllers\HomeControler;
use App\Http\Controllers\ModelControler;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeControler::class, 'index'])->middleware('auth');
Route::get('/home', [HomeControler::class, 'index'])->middleware('auth');

Route::get('/login', [HomeControler::class, 'login'])->middleware([RedirectIfAuthenticated::class])->name('login');
Route::post('/login', [HomeControler::class, 'store_login']);
Route::post('/logout', [HomeControler::class, 'logout']);


Route::post('/model', [HomeControler::class, 'store_model']);
Route::get('/model', [ModelControler::class, 'index']);

Route::post('/tabel', [ModelControler::class, 'store_tabel']);

Route::post('/pola', [ModelControler::class, 'store_pola']);

Route::post('/train', [ModelControler::class, 'train_pola']);

Route::post('/save-model', [ModelControler::class, 'save_model']);

Route::post('/prediksi', [HomeControler::class, 'prediksi']);