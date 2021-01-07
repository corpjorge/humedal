<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeContoller;



Route::get('/', [HomeContoller::class, 'index']);

