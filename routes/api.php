<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CanidatesController;
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
Route::middleware(['verify.token'])->group(function () {  
        Route::post('/add-canidate', [CanidatesController::class, 'addCanidate'])->name('add.canidate');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
