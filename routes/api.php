<?php

use App\Http\Controllers\Api\AdminCRUDController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarCRUDController;
use App\Http\Controllers\Api\CarTypeCRUDController;
use App\Http\Controllers\Api\RentCRUDController;
use App\Http\Controllers\Api\CarAppointmentCRUDController;
use App\Http\Controllers\Api\RentActionsContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/v1')
    ->group(function () {
        Route::controller(AuthController::class)
            ->group(function () {
                Route::post('/login', 'login');
                Route::post('/logout', 'logout')->middleware('auth:sanctum');
            });

        Route::controller(AdminCRUDController::class)
            ->prefix('/admins')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/{id}', 'show');
                Route::post('/', 'store');
                Route::post('/{id}', 'update');
                Route::delete('/{id}', 'destroy');
            });

        Route::controller(CarCRUDController::class)
            ->prefix('/cars')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/{id}', 'show');
                Route::post('/', 'store');
                Route::post('/{id}', 'update');
                Route::delete('/{id}', 'destroy');
            });

        Route::controller(CarTypeCRUDController::class)
            ->prefix('/car-types')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/{id}', 'show');
                Route::post('/', 'store');
                Route::post('/{id}', 'update');
                Route::delete('/{id}', 'destroy');
            });

        Route::controller(CarAppointmentCRUDController::class)
            ->prefix('/car-appointments')
            ->group(function () {
                Route::get('/{id}', 'show');
            });

        Route::controller(RentCRUDController::class)
            ->prefix('/rents')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/{id}', 'show');
                Route::post('/', 'store');
                Route::delete('/{id}', 'destroy');
            });
        Route::post('/rents/{id}/approval', [RentActionsContoller::class, 'approval']);
    });
