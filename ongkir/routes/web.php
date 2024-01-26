<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [CheckoutController::class, 'checkout']);
Route::get('/province', [CheckoutController::class, 'get_province']);
Route::get('/kota/{id}', [CheckoutController::class, 'get_city']);
Route::get('/origin={city_origin}&destination={city_destination}&weight={weight}&courier={courier}', [CheckoutController::class, 'get_ongkir']);
