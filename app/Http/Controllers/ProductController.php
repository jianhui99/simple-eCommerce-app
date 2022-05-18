<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WpProduct;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderProduct;
use DB;
use Session;
use App\Helper\General;

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
            if($duplicateItem = Cart::where('user_id', Auth::user()->id)->where('product_id', $productId)->first()){
                $duplicateItem->increment('quantity');
            }else{
                Cart::create([
                    'user_id'   =>  Auth::user()->id,
                    'product_id'  =>  $productId,
                    'quantity'  =>  1,
                    'session_id'    => Session::getId(),
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect( route('home') )->with('error', $ex->getMessage());
        }

        Session::put('cartCount', General::get_cart_count());

        return redirect( route('cart') )->with('success', 'Item was added to your cart!');
    }

    public function remove_cart_item(Request $request){
        Cart::where('user_id', Auth::user()->id)->where('id', $request->cart_id)->delete();

        return redirect( route('cart') )->with('success', 'Item was removed from your cart!');

    }

    public function submit_order(Request $request){
        $userCartItems = Cart::where('user_id', Auth::user()->id)->get();
        if($userCartItems->count() == 0){
            return redirect( route('home') )->with('error', 'There are no items in this cart!');
        }

        DB::beginTransaction();

        // create order
        try {
            // $duplicateItem = OrderProduct::where('user_id', Auth::user()->id)
            $order = Order::create([
                'user_id'   =>  Auth::user()->id,
                'order_status'  =>  2
            ]);

            foreach($userCartItems as $item){
                OrderProduct::create([
                    'order_id'  =>  $order->id,
                    'product_id'  =>  $item->product_id,
                    'quantity'  =>  $item->quantity,
                ]);
            }
            
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect( route('home') )->with('error', $ex->getMessage());
        }

        // clear cart after submit order
        $this->clear_cart();
        
        Session::put('cartCount', General::get_cart_count());

        return redirect( route('order.history') )->with('success', 'Your order has been submitted!');
    }

    public function clear_cart(){
        return Cart::where('user_id', Auth::user()->id)->delete();
    }


}
