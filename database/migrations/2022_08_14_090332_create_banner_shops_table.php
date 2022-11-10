<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_shops', function (Blueprint $table) {
            $table -> id();

            $table -> string('image_desktop');
            $table -> string('image_mobile');
            $table -> string('url') -> nullable();

            $table -> boolean('status') -> default(0);

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
        Schema::dropIfExists('banner_shops');
    }
}
