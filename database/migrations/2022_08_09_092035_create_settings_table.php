<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table -> id();
            $table -> float('dolar', 20, 2);
            $table -> float('shipping', 20, 2);
            $table -> boolean('cta_status') -> default(0);
            $table -> string('cta_title') -> nullable();
            $table -> text('cta_description') -> nullable();
            $table -> string('cta_button_text') -> nullable();
            $table -> string('cta_button_link') -> nullable();
            $table -> string('cta_background') -> nullable();
            $table -> string('message_top') -> nullable();
            $table -> boolean('message_status') -> default(0);
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
        Schema::dropIfExists('settings');
    }
}
