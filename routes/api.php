<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientController;
use App\Http\Middleware\ApiKeyAuth;

Route::middleware([ApiKeyAuth::class, 'throttle:60,1'])->group(function () {
    Route::resource('patients', PatientController::class);
});
