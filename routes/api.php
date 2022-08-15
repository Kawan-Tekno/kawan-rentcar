<?php

use App\Http\Controllers\Api\AdminCRUDController;
use App\Http\Controllers\Api\CarCRUDController;
use App\Http\Controllers\Api\RentCRUDController;
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

        Route::controller(RentCRUDController::class)
            ->prefix('/rents')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/{id}', 'show');
                Route::post('/', 'store');
                Route::delete('/{id}', 'destroy');
            });
    });
