<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Datos globales 
    |--------------------------------------------------------------------------
    |
    | Variables de acceso al api  
    |
    */

 
    'url' =>  env('WEATHER_URL', 'https://weather-ydn-yql.media.yahoo.com/forecastrss'),

    'app_id' =>  env('WEATHER_APP_ID', 'CUdvw2Ar'),

    'consumer_key' =>  env('WEATHER_COMSUMER_KEY', 'dj0yJmk9aHoyZGVLOUlUWk9wJmQ9WVdrOVExVmtkbmN5UVhJbWNHbzlNQT09JnM9Y29uc3VtZXJzZWNyZXQmc3Y9MCZ4PTJk'),

    'consumer_secret' =>  env('WEATHER_COMSUMER_SECRET', 'e65de4bac2b4b3be0ecbc4958d640fb153175a77')

];