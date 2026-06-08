<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/live1', function () {
    return view('liveone');
});

Route::get('/live2', function () {
    return view('livetwo');
});

Route::get('/live3', function () {
    return view('livethree');
});

Route::get('/live4', function () {
    return view('livefour');
});

Route::get('calendar', function () {
    return view('calendar');
});

Route::get('option', function () {
    return view('options');
});
