<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table -> id();

            $table -> string('shop_name');

            $table -> text('description') -> nullable();

            $table -> string('logo') -> nullable();
            $table -> string('logo_foot') -> nullable();
            $table -> string('slug');
            $table -> string('domain') -> nullable();

            $table -> boolean('domain_status') -> nullable();

            $table -> string('facebook') -> nullable();
            $table -> string('instagram') -> nullable();
            $table -> string('whatsapp') -> nullable();
            $table -> string('shop_mail') -> nullable();

            $table -> json('banners') -> nullable();
            $table -> json('categories') -> nullable();

            $table -> boolean('cash') -> nullable();
            $table -> boolean('bank') -> nullable();
            $table -> boolean('mpago') -> nullable();

            $table -> string('bank_name') -> nullable();
            $table -> string('bank_titular') -> nullable();
            $table -> string('bank_cuit') -> nullable();
            $table -> string('bank_cbu') -> nullable();
            $table -> string('bank_alias') -> nullable();

            $table -> string('mp_public_key') -> nullable();
            $table -> string('mp_access_token') -> nullable();

            $table -> boolean('delivery_home') -> default(0);
            $table -> boolean('delivery_coordinate') -> default(0);

            $table -> string('meta_title') -> nullable();
            $table -> string('meta_description') -> nullable();
            $table -> string('meta_keywords') -> nullable();
            $table -> string('google_analytics') -> nullable();
            $table -> string('facebook_pixel') -> nullable();

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
        Schema::dropIfExists('shops');
    }
}
