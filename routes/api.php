<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('userLogin', [UserLoginController::class, 'loginapi']);
Route::get('/analyticsData', [DashboardController::class, 'analyticsData']);

Route::get('dashboardStatus', [ApiController::class, 'dashboardStatus']);
Route::get('getProfile', [ApiController::class, 'getProfile']);
Route::get('capaStatus', [ApiController::class, 'capaStatus']);

