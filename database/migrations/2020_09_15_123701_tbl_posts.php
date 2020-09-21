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
            $table->Increments('posts_id')->unsigned();
            $table->Integer('post_category_id')->unsigned();
            $table->String('posts_name');
            $table->Longtext('posts_content');
            $table->String('posts_slug');
            $table->String('posts_image');
            $table->String('posts_meta_keywords');
            $table->LongText('posts_description');
            $table->Integer('posts_status')->unsigned();
            $table->engine = 'InnoDB';
            $table->timestamps();
        });
        Schema::table('tbl_posts',function (Blueprint $table){
            $table->foreign('post_category_id')->references('post_category_id')->on('tbl_category_post');
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
