<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table -> unsignedBiginteger('shipping_id') -> nullable() -> after('token');
            $table -> foreign('shipping_id') -> references('id') -> on('shippings') -> nullOnDelete();

            $table -> unsignedBiginteger('responsable_id') -> nullable() -> after('shipping_id');
            $table -> foreign('responsable_id') -> references('id') -> on('users') -> nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
