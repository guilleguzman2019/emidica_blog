<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table -> id();

            $table -> string('product_name');
            $table -> string('sku');

            $table -> json('variation') -> nullable();

            $table -> integer('quantity');

            $table -> float('price_cost_usd');
            $table -> float('price_cost_ars');
            $table -> float('price_regular');
            $table -> float('price_sale');
            $table -> float('total_cost_ars');
            $table -> float('total');

            $table -> unsignedBigInteger('order_id');
            $table -> foreign('order_id') -> references('id') -> on('orders') -> onDelete('cascade');

            $table -> unsignedBigInteger('product_id') -> nullable();
            $table -> foreign('product_id') -> references('id') -> on('products') -> nullOnDelete();

            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
