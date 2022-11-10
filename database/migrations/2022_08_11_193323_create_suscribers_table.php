<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Suscriber;

class CreateSuscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suscribers', function (Blueprint $table) {
            $table -> id();

            $table -> integer('doc_number');
            $table -> string('birthdate');
            $table -> string('phone') ;
            $table -> string('address');
            $table -> string('city');
            $table -> string('province');
            $table -> string('zip');
            $table -> string('voucher') -> nullable();

            $table -> boolean('status') -> nullable();

            $table -> tinyInteger('plan') -> nullable();
            $table -> enum('payment_method', [Suscriber::DEBIT, Suscriber::TRANSFER]) -> nullable();
            $table -> string('preapproval_id') -> nullable();

            $table -> date('start_date') -> nullable();
            $table -> date('renovation_date') -> nullable();

            $table -> unsignedBiginteger('user_id');
            $table -> foreign('user_id') -> references('id') -> on('users') -> onDelete('cascade');

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
        Schema::dropIfExists('suscribers');
    }
}
