<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblCategoryPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_category_post', function (Blueprint $table) {
            $table->Increments('post_category_id');
            $table->String('post_category_name');
            $table->LongText('post_category_name');
            $table->String('post_category_name');
            $table->String('post_category_meta_keywords');
            $table->Integer('post_category_status');
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
        Schema::dropIfExists('tbl_category_post');
    }
}
