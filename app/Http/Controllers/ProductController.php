<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(\GuzzleHttp\Client $client)
    {
    }

    public function add_cart(Request $request){
        dd($request->all());
    }
}
