<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\TwoDigitCrawlerController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ScheduleController;

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
    return view('view');
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

// Route::get('calendar', [CalendarController::class, 'index'])->name('calendar.index');
// Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');
// Route::patch('calendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
// Route::delete('calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');



