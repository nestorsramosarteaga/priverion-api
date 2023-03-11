<?php

use App\Http\Controllers\Api\V1\EmployeeController;
use App\Http\Controllers\Api\V1\AuthController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => '/v1',
    'as' => 'v1',
  ], function () {

    Route::post('auth', [AuthController::class, 'auth']);

    Route::apiResource('employees', EmployeeController::class)
        ->middleware('auth:sanctum');
});