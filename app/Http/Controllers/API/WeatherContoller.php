<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeatherContoller extends Controller
{
    public $url;
    public $app_id;
    public $consumer_key;
    public $consumer_secret;

    function __construct()
    {
        $this->url = config('weather.url');
        $this->app_id = config('weather.app_id');
        $this->consumer_key = config('weather.consumer_key');
        $this->consumer_secret = config('weather.consumer_secret');
    }

    function weatherIndex($location = 'bogota')
    {         
        $query = array(
            'location' => $location,
            'format' => 'json',
            'u' => 'c'
        );

        $oauth =  $this->oauth();  
 
        $base_info = $this->buildBaseString($this->url, 'GET', array_merge($query, $oauth));
        $composite_key = rawurlencode($this->consumer_secret) . '&';
        $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
        $oauth['oauth_signature'] = $oauth_signature;
        
        return json_decode($this->requestCurl($oauth, $query), true);
  
    }

    function oauth(): array 
    {
        return [
            'oauth_consumer_key' => $this->consumer_key,
            'oauth_nonce' => uniqid(mt_rand(1, 1000)),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => time(),
            'oauth_version' => '1.0'
        ];

    }

    function requestCurl($oauth, $query)
    {
        $header = array(
            $this->buildAuthorizationHeader($oauth, $query),
            'X-Yahoo-App-Id: ' . $this->app_id
        );

        $options = array(
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_HEADER => false,
            CURLOPT_URL => $this->url . '?' . http_build_query($query),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        return curl_exec($ch);         
    }


    function buildBaseString($baseURI, $method, $params)
    {
        $r = array();
        ksort($params);
        foreach ($params as $key => $value) {
            $r[] = "$key=" . rawurlencode($value);
        }
        return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
    }

    function buildAuthorizationHeader($oauth)
    {
        $r = 'Authorization: OAuth ';
        $values = array();
        foreach ($oauth as $key => $value) {
            $values[] = "$key=\"" . rawurlencode($value) . "\"";
        }
        $r .= implode(', ', $values);
        return $r;
    }
}
