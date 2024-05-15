<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rota para a página de lentes
Route::get('/lentes', function () {
    return view('lentes');
});

// Rota para a página de vídeos
Route::get('/videos', function () {
    return view('videos');
});

// Rota para a página de galeria
Route::get('/galeria', function () {
    return view('galeria');
});

// Rota para a página de desativados
Route::get('/desativados', function () {
    return view('desativados');
});

// Rota para a página de desativados
Route::get('/configuracoes', function () {
    return view('configuracoes');
});
