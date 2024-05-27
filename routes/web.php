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

Auth::routes();


Route::get('/', function () {
    return view('totem.index');
});


// Totem Content
Route::get('/menu-content', function () {
    return view('totem.menu');
});

// Totem Content
Route::get('/galeria-content', function () {
    return view('totem.galeria');
});

// Totem Content
Route::get('/videos-content', function () {
    return view('totem.videos');
});

// Totem Content
Route::get('/camera-content', function () {
    return view('totem.camera');
});

// Totem Content
Route::get('/comparison-content', function () {
    return view('totem.comparacao');
});

// Totem Content
Route::get('/teste', function () {
    return view('totem.teste');
});

Route::get('/admin', function () {
    return view('admin.index');
});

Route::get('/admin/lentes-content', function () {
    return view('admin.lentes');
});

Route::get('/admin/videos-content', function () {
    return view('admin.videos');
});

Route::get('/admin/galeria-content', function () {
    return view('admin.galeria');
});








