<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CanidatesController;
use App\Http\Controllers\API\EventsController;
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
        Route::get('/get-canidate-categories', [CanidatesController::class, 'getCanidateCategories'])->name('getCanidateCategories');
        Route::post('/get-event-by-name', [EventsController::class, 'getEventByName'])->name('getEventByName');
        
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
