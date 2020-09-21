<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order_details', function (Blueprint $table) {
            $table->Increments('order_details_id')->unsigned();
            $table->String('order_code')->index();
            $table->Integer('product_id')->unsigned();
            $table->String('product_name');
            $table->String('product_price');
            $table->Integer('product_sales_quantity')->unsigned();
            $table->String('product_coupon');
            $table->String('product_feeship');
            $table->engine="InnoDB";

            $table->timestamps();
        });
        Schema::table('tbl_order_details',function(Blueprint $table){
            $table->foreign('product_id')->references('product_id')->on('tbl_product');
            $table->foreign('order_code')->references('order_code')->on('tbl_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_order_details');
    }
}
