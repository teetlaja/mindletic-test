<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PsychologistController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/hello', function () {
    return "Hello World API";
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user/{id}', 'show');
    Route::post('/user', 'store');
});



Route::controller(PsychologistController::class)->group(function () {
    Route::get('/psychologist/{id}', 'show');
    Route::post('/psychologist', 'store');
});

Route::controller(BusinessController::class)->group(function () {
    Route::get('/business/{id}', 'show');
    Route::post('/business', 'store');
    // TODO: This must be fixed, postponed in advance of other tables
    Route::post('/business/{businessid}/addEmployee/{userid}', 'addEmployee');
});

Route::resource('booking', BookingController::class);
Route::resource('invoice', InvoiceController::class);
Route::resource('payment', PaymentController::class);