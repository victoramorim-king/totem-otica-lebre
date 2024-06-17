<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\VideoController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/images/{tipo}', [ImageController::class, 'index'])->name('getAllImages');
Route::post('/images', [ImageController::class, 'store'])->name('uploadImage');
Route::put('/images/{id}', [ImageController::class, 'update'])->name('updateImage');
Route::delete('/images/{id}', [ImageController::class, 'destroy'])->name('deleteImage');


Route::get('/videos', [VideoController::class, 'index'])->name('getAllVideos');
Route::post('/videos', [VideoController::class, 'store'])->name('uploadVideo');
Route::put('/videos/{id}', [VideoController::class, 'update'])->name('updateVideo');
Route::delete('/videos/{id}', [VideoController::class, 'destroy'])->name('deleteVideo');




