<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order', function (Blueprint $table) {
            $table->Increments('order_id')->unsigned();
            $table->Integer('shipping_id')->index()->unsigned();
            $table->Integer('customer_id')->index()->unsigned();
            $table->Integer('order_status')->unsigned();
            $table->String('order_code')->index();
            $table->engine = 'InnoDB';
            $table->timestamps();
        });
        Schema::table('tbl_order',function (Blueprint $table){
            $table->foreign('shipping_id')->references('shipping_id')->on('tbl_shipping');
            $table->foreign('customer_id')->references('customer_id')->on('tbl_customer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_order');
    }
}
