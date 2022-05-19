<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WpProduct;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'order_status',
    ];

    protected $appends = [
        'order_product_list'
    ];
    
    public function order_products() {
        return $this->hasMany(OrderProduct::class, 'order_id','id');
    }

    public function getorderProductListAttribute(){
        $orders = $this->order_products()->get();
        $data = [];
        if($orders->count() != 0){
            foreach($orders as $key => $order){
                $data[$key]['product_info'] = WpProduct::where('id', $order->product_id)->first();
                $data[$key]['qty'] = $order->quantity;
            }
        }
        return $data;
    }

    public static $code_to_status = [
        0   =>  'Failed',
        1   =>  'Completed',
        2   =>  'Pending',
        3   =>  'Processing',
        9   =>  'Canceled',
    ];

    public static $code_to_color = [
        0   =>  'danger',
        1   =>  'success',
        2   =>  'warning',
        3   =>  'info',
        9   =>  'danger',
    ];
}
