<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_posts', function (Blueprint $table) {
            $table->Increments('posts_id');
            $table->Integer('post_category_id');
            $table->String('posts_name');
            $table->String('posts_content');
            $table->String('posts_slug');
            $table->String('posts_image');
            $table->String('posts_meta_keywords');
            $table->LongText('posts_description');
            $table->Integer('posts_status');
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
        Schema::dropIfExists('tbl_posts');
    }
}
