<?php

use App\Http\Controllers\KlasemenController;
use App\Http\Controllers\KlubController;
use App\Http\Controllers\SkorController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [KlasemenController::class, 'index']);
// Route Klub
Route::prefix('klub')->group(function () {
    // index
    Route::get('/', [KlubController::class, 'index']);
    // create
    Route::get('create', [KlubController::class, 'createView']);
    Route::post('create', [KlubController::class, 'create']);
    // update
    Route::get('update/{id}', [KlubController::class, 'updateView']);
    Route::put('update/{id}', [KlubController::class, 'update']);
    // delete
    Route::get('delete/{id}', [KlubController::class, 'delete']);
});
// Route Skor
Route::prefix('skor')->group(function () {
    // index
    Route::get('/', [SkorController::class, 'index']);
    // create single
    Route::post('create-single', [SkorController::class, 'createSingle']);
    // create multiple
    Route::post('create-multiple', [SkorController::class, 'createMultiple']);
    // delete
    Route::get('delete/{id}/{type}', [SkorController::class, 'delete']);
});
