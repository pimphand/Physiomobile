<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientController;


Route::get('/', function () {
    return view('welcome');
});
Route::resource('patients', PatientController::class);
