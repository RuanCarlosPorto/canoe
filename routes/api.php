<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\FundInvestInCompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::group(['prefix' => '/companies'], function () {
    Route::post('/', [CompanyController::class, 'store']);
    Route::get('/', [CompanyController::class, 'index']);
});

Route::group(['prefix' => '/funds'], function () {
    Route::get('/', [FundController::class, 'index']);
    Route::post('/', [FundController::class, 'store']);
    Route::put('/{id}', [FundController::class, 'update']);
    Route::delete('/{id}', [FundController::class, 'delete']);
    Route::get('/duplicates', [FundController::class, 'duplicates']);
});

Route::group(['prefix' => '/fund-invest-in-companies'], function () {
    Route::post('/', [FundInvestInCompanyController::class, 'store']);
});
