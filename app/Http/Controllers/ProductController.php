<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WpProduct;
use App\Models\Order;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\OrderProduct;
use DB;
use Session;

class ProductController extends Controller
{

    public function __construct(\GuzzleHttp\Client $client)
    {
    }

    public function add_cart(Request $request){
        $productId = $request->product_id;

        // check product still available
        if(!WpProduct::find($productId)){
            return redirect( route('home') )->with('error', 'Selected item was no longer available.');
        }

        if(!Auth::user()){
            return redirect()->route('login');
        }

        DB::beginTransaction();
        try {
            // check duplicate item
            // $userCarts = Cart::join('cart_products', 'carts.id', '=' , 'cart_products.cart_id')
            //                     ->where('carts.user_id', Auth::user()->id)
            //                     ->get();

            // if(count($$userCarts) != 0){
            //     dd('123');
            //     foreach($userCarts as $cart){
            //         dd($cart);
            //         if($cart->product_id == $productId){

            //         }
            //     }
            // }else{
            //     dd('1');
                $newCart = Cart::create([
                    'user_id'   =>  Auth::user()->id,
                    'quantity'  =>  1,
                    'session_id'    => Session::getId(),
                ]);
    
                CartProduct::create([
                    'cart_id'   =>  $newCart->id,
                    'product_id'  =>  $productId,
                ]);
            // }
            
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect( route('home') )->with('error', $ex->getMessage());
        }

        $itemCount = Cart::where('user_id', Auth::user()->id)->count();
        Session::put('cartCount', $itemCount);

        return redirect( route('home') )->with('success', 'Item was added to your cart!');
    }

    public function remove_cart_item(Request $request, $cid){

    }

    public function submit_order(){
        
        DB::beginTransaction();

        // create order
        try {
            // $duplicateItem = OrderProduct::where('user_id', Auth::user()->id)
            $createOrder = Order::create([
                'user_id'   =>  Auth::user()->id,
                'order_status'  =>  2
            ]);
    
            OrderProduct::create([
                'order_id'  =>  $createOrder->id,
                'product_id'  =>  $productId,
                'quantity'  =>  1,
            ]);
            
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect( route('home') )->with('error', $ex->getMessage());
        }

        $orders = Order::where('user_id', Auth::user()->id)->where('order_status', 2)->count();
        Session::put('cartCount', $orders);
    }
}
