<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table -> id();

            $table -> string('image_desktop');
            $table -> string('image_mobile');
            $table -> string('url') -> nullable();

            $table -> tinyInteger('order') -> nullable();
            $table -> tinyInteger('location');

            $table -> boolean('status') -> default(0);

            $table -> unsignedBiginteger('category_id');
            $table -> foreign('category_id') -> references('id') -> on('categories') -> onDelete('cascade');

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
        Schema::dropIfExists('banners');
    }
}
