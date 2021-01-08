<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\WeatherContoller;

Route::get('/weather/{location?}', [WeatherContoller::class, 'weatherindex']);