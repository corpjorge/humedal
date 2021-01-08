<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeContoller;
use App\Http\Controllers\HistorialContoller;


Route::get('/', HomeContoller::class);
Route::get('/historial', HistorialContoller::class)->name('historial');