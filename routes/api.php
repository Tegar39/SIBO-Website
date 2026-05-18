<?php

use App\Http\Controllers\Api\AnggotaApiController;
use Illuminate\Support\Facades\Route;

Route::post('/pac-list', [AnggotaApiController::class, 'getPacList']);
Route::post('/anggota', [AnggotaApiController::class, 'showData']);
Route::post('/anggota-crud', [AnggotaApiController::class, 'queryCrud']);
Route::post('/stats', [AnggotaApiController::class, 'getStats']);