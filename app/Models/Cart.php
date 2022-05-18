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
        'user_id', 'product_id','session_id', 'quantity'
    ];

    protected $appends = [
        'product_list'
    ];

    public function products() {
        return $this->hasMany(WpProduct::class, 'id','product_id');
    }

    public function getProductListAttribute(){
        return $this->products()->get();
    }
}
