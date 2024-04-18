<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::get('/home', function () {
    return view('home');
});

Route::get('/model', function () {
    return view('model');
});
