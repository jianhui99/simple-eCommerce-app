<?php

namespace App\Helper;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class General{
    public function get($url,$header = null)
    {
        $client = new \GuzzleHttp\Client(['base_uri' =>  $url]);
        $res = $client->request('GET', $url,['headers' =>  $header]);
        $statusCode= $res->getStatusCode();
        
        $header= $res->getHeader('content-type');
        
        $data = $res->getBody();
        
        return $data;
    }
}