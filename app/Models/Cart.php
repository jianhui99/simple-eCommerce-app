<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WpProduct;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'user_id', 'session_id', 'quantity'
    ];

    protected $appends = [
        'product_list'
    ];

    public function products() {
        return $this->hasMany(CartProduct::class, 'cart_id','id');
    }

    public function getProductListAttribute(){
        $products = $this->products()->get();
        $data = [];
        foreach($products as $product){
            $data['product_info'] = WpProduct::where('id', $product->product_id)->first();
        }

        return $data;
    }
}
