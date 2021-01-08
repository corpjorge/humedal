<?php

namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Http;

class HomeContoller extends Controller
{
    public function __invoke()
    {
        return view('welcome');
    }
}
