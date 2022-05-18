<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\General;
use GuzzleHttp\Client;
use App\Models\WpProduct;
use App\Models\WpProductImage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(\GuzzleHttp\Client $client)
    {
        // $this->middleware('auth');
        $this->client = $client;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        try{
            $products = WpProduct::where('status', 1)->paginate(10, ['*'], 'product');
        }catch (\Exception $e){
            
        }

        return view('home', compact('products'));
    }

    public function cart(Request $request){
        return view('cart');
    }

    public function notification(Request $request){
        return view('notification');
    }

    public function loading(Request $request){
        return view('loading');
    }
}
