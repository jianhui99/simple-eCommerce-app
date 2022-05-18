<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use App\Models\WpProductImage;

class WpProduct extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function getCreatedAtAttribute($val)
    {
        return date('Y-m-d H:i:s', strtotime($val));
    }

    public function getUpdatedAtAttribute($val)
    {
        return date('Y-m-d H:i:s', strtotime($val));
    }

    protected $appends = [
        'product_image_list'
    ];

    public function images(){
        return $this->hasMany(WpProductImage::class, 'wp_product_id', 'wp_product_id');
    }

    public function getProductImageListAttribute(){
        return $this->images()->get();
    }

    public function getDescriptionAttribute($val, $n=100){
        // return empty($val) ? '-' : substr($val,0,$n). '...';
        return empty($val) ? '-' : $val;

    }

    public function getSkuAttribute($val){
        return empty($val) ? '-' : $val;
    }

    public static $wp_products_list = array();

    public static function call_wp_products($url = '', $page = 1){
        $rs = '';
        if(!empty($url)){
            $rs = Http::get($url, [
                'page' => $page,
            ]);

            if(!empty($rs)){
                $rs = json_decode($rs, true);   
                if(!empty($rs)){
                    if(isset($rs['data']) && $rs['data']['status'] == 400){
                        return self::$wp_products_list;
                    }else{
                        self::$wp_products_list = (empty(self::$wp_products_list))? $rs : array_merge(self::$wp_products_list, $rs); 
                        $nextPage = $page + 1;
                        self::call_wp_products($url, $nextPage);
                    }
                }
            }
        }
        return self::$wp_products_list; 
    }

    public static function insert_wp_products_record($data){
        foreach($data as $val){
            $exist = self::where('wp_product_id', $val['id'])->first();
            if(empty($exist)){
                $wpProduct = new WpProduct;
                $wpProduct->wp_product_id = $val['id'];
                $wpProduct->product_name = $val['name'];
                $wpProduct->description = $val['description'];
                $wpProduct->sku = $val['sku'];
                $wpProduct->regular_price = empty($val['regular_price']) ? 0 : $val['regular_price'];
                $wpProduct->in_stock = $val['in_stock'];
                $wpProduct->save();
            }

            foreach($val['images'] as $img){
                $existImg = WpProductImage::where('wp_product_id', $val['id'])->where('src', $img['src'])->first();
                if(!$existImg){
                    WpProductImage::create([
                        'wp_product_id' =>  $val['id'],
                        'src'   =>  $img['src'],
                    ]);
                }

            }
        }
    }
}
