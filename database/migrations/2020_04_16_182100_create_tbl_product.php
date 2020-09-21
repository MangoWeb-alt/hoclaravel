<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->Increments('product_id')->unsigned();
            $table->Integer('category_id')->index()->unsigned();
            $table->Integer('brand_id')->index()->unsigned();
            $table->String('product_name');
            $table->String('product_description');
            $table->String('meta_product_keywords');
            $table->String('product_content');
            $table->String('product_price');
            $table->String('product_quantity');
            $table->String('product_sold');
            $table->String('product_image');
            $table->Integer('product_status')->unsigned();
            $table->engine='InnoDB';
            $table->timestamps();
        });
        Schema::table('tbl_product',function (Blueprint $table){
            $table->foreign('category_id')->references('category_id')->on('tbl_category');
            $table->foreign('brand_id')->references('brand_id')->on('tbl_brand');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_product');
    }
}
