<?php

use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;

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


Route::get('/visits/statistics', [VisitController::class, 'getStatistics']);
Route::post('/visits/{countryCode}', [VisitController::class, 'recordVisit']);
