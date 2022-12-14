<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tags', function (Blueprint $table) {
            $table->id();

            $table -> unsignedBiginteger('post_id');
            $table -> foreign('post_id') -> references('id') -> on('posts') -> onDelete('cascade');

            $table -> unsignedBiginteger('tagBlog_id');
            $table -> foreign('tagBlog_id') -> references('id') -> on('tag_blogs') -> onDelete('cascade');
            
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
        Schema::dropIfExists('post_tags');
    }
}
