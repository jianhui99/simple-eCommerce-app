<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    protected $fillable = [
        'wp_product_id', 'src'
    ];

    public function getCreatedAtAttribute($val)
    {
        return date('Y-m-d H:i:s', strtotime($val));
    }

    public function getUpdatedAtAttribute($val)
    {
        return date('Y-m-d H:i:s', strtotime($val));
    }
}
