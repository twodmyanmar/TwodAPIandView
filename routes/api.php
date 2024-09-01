<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HintController;
use App\Http\Controllers\WatchController;
use App\Http\Controllers\ScheduleController;
// use App\Http\Controllers\TwoDigitCrawlerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/live', [ApiController::class, 'live']);

Route::post('live/create', [ApiController::class, 'create']);
Route::put('live/update/{id}', [ApiController::class, 'update']);
Route::post('live/auto-update', [ApiController::class, 'autoUpdate']);


Route::get('/threed/live', [ApiController::class, 'threedlive']);
//Route::get('/fourd/live', [ApiController::class, 'fourdlive']);
Route::get('/watch', [ApiController::class, 'watch']);
// Route::get('/watch', [WatchController::class,'index']);
Route::get('/watch',[WatchController::class,'index']);
Route::get('/watch/weekly',[WatchController::class,'weekly']);
Route::get('/live/yesterday',[ApiController::class,'yesterdayLive']);
Route::get('/live/yesterday/2',[ApiController::class,'lastTwoDayLive']);
Route::get('/calendar',[ApiController::class,'calendar']);
Route::get('hints/yesterday',[HintController::class,'yesterdayHints']);
Route::get('result/weekly', [WatchController::class, 'weeklyResult']);


Route::get('/event-days', [ScheduleController::class, 'getEventDays']);

Route::resource('/event_days', ScheduleController::class);
