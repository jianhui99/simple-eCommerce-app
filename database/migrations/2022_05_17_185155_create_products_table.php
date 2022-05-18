<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('wp_product_id');
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->string('sku');
            $table->float('regular_price', 10, 2);
            $table->tinyinteger('in_stock')->comment('1=in stock, 0=out of stock');
            $table->tinyinteger('status')->comment('1=active, 0=inactive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
