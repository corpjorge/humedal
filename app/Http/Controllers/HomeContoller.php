<?php

namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Http;

class HomeContoller extends Controller
{
    public function index()
    {
        $miami   = Http::get('http://humedal.test:8080/api/weather/miami');
        $orlando = Http::get('http://humedal.test:8080/api/weather/orlando');
        //$newyork = Http::get('http://humedal.test:8080/api/weather/newyork');

        //return view('welcome', [ 'miami' => $miami, 'orlando' => $orlando, 'newyork' => $newyork ]);
    }
}
