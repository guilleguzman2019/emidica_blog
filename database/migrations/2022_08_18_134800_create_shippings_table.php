<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Shipping;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table -> id();

            $table -> enum('status', [Shipping::PENDING, Shipping::SENT_VOUCHER, Shipping::PAYED, Shipping::SENT]);

            $table -> float('subtotal', 10,2);
            $table -> float('shipping_cost', 10,2) -> nullable();
            $table -> float('total', 10,2);

            $table -> unsignedBiginteger('shop_id');
            $table -> foreign('shop_id') -> references('id') -> on ('shops') -> onDelete('cascade');

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
        Schema::dropIfExists('shippings');
    }
}
