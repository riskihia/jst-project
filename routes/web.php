<?php

use App\Http\Controllers\HomeControler;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeControler::class, 'index'])->middleware('auth');
Route::get('/home', [HomeControler::class, 'index'])->middleware('auth');

Route::get('/login', [HomeControler::class, 'login'])->middleware([RedirectIfAuthenticated::class])->name('login');
Route::post('/login', [HomeControler::class, 'store_login']);
Route::post('/logout', [HomeControler::class, 'logout']);


Route::get('/model', function () {
    return view('model');
});
