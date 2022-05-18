<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\General;
use GuzzleHttp\Client;
use App\Models\WpProduct;
use App\Models\WpProductImage;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Cart;
use Session;
use Illuminate\Support\Facades\Auth;

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
            $products = WpProduct::where('status', 1)->paginate(WpProduct::$paginate, ['*'], 'product');
        }catch (\Exception $e){
            
        }

        return view('home', compact('products'));
    }

    public function cart(Request $request){
        // $items = Cart::where('user_id', Auth::user()->id)->paginate(2, ['*'], 'product');
        $items = Cart::where('user_id', Auth::user()->id)->get();
        $total_price = 0;
        foreach($items as $item){
            $total_price += $item->product_list[0]->regular_price * $item->quantity;
        }

        Session::put('cartCount', General::get_cart_count());
        
        return view('cart.cart', compact('items', 'total_price'));
    }

    public function notification(Request $request){
        return view('notification');
    }

    public function order_history(Request $request){
        $items = Order::where('user_id', Auth::user()->id)->paginate(WpProduct::$paginate, ['*'], 'order_history');

        return view('order.history', compact('items'));
    }
    
}
