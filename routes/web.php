<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('window');
});

Route::get('/Table_area', function () {
    return view('Table_area');
});