<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/logout', function () {
    return redirect()->action([HomeController::class, 'index'], ['sourceUrl' => 'Logout']);
});

Route::get('/external', function () {
    return redirect()->away('https:/www.dicoding.com');
});



