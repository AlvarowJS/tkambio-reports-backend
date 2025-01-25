<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReportController as Report;
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
Route::post('/generate-report',         [Report::class, 'generateReport']);
Route::get('/get-report/{report_id}',  [Report::class, 'getReport']);
Route::get('/list-reports',            [Report::class, 'listReport']);
