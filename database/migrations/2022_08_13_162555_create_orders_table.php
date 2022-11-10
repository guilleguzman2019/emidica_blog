<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Order;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table -> id();

            $table -> string('customer_name');
            $table -> string('customer_email');
            $table -> integer('customer_doc') -> nullable();
            $table -> string('customer_phone');
            $table -> string('customer_address') -> nullable();
            $table -> string('customer_number') -> nullable();
            $table -> string('customer_neighbohood') -> nullable();
            $table -> string('customer_city') -> nullable();
            $table -> string('customer_province') -> nullable();
            $table -> string('customer_zip') -> nullable();

            $table -> boolean('email_marketing') -> nullable();

            $table -> enum('status', [Order::PENDING, Order::PAYED, Order::ON_PROCESS, Order::REJECT, Order::REQUEST_SHIPPING, Order::REQUEST_SHIPPING_APPROVE, Order::IN_PREPARATION, Order::READY_TO_SHIPPING, Order::DISPATCHED, Order::CANCELED]) -> default(Order::PENDING);
            $table -> enum('shipping_type', [1, 2]);

            $table -> float('shipping_cost') -> nullable();
            $table -> float('subtotal');
            $table -> float('total');

            $table -> tinyInteger('payment_method') -> nullable();

            $table -> string('token');
            $table -> string('tracking_code') -> nullable();

            $table -> unsignedBiginteger('shop_id');
            $table -> foreign('shop_id') -> references('id') -> on ('users') -> onDelete('cascade');

            $table -> softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
