<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BlogController;

Route::get('/', function (Request $request) {
    return view('home.index');
})->name('home.index');

Route::get('/contact', function(){
    return view('home.contact');
})->name('home.contact');

Route::resource('posts', BlogController::class)
    ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);


