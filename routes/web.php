<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('window');
});

Route::get('/teste', function () {
    return view('window');
});