<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\app\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    return view('test');
})->name('test');


Route::resource('products', 'App\Http\Controllers\app\ProductController');
Route::resource('categories', 'App\Http\Controllers\app\CategoryController');
// Route::get('pro/{get}/add', [ProductController::class, 'add'])->name('pro.add');
// Route::post('pro/{post}/addto', [ProductController::class, 'addto'])->name('pro.addto');

