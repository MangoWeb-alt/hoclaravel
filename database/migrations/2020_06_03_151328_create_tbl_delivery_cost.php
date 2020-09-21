<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDeliveryCost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tinhthanhpho', function (Blueprint $table) {
            $table->Increments('matp')->unsigned();
            $table->String('name_city',100);
            $table->String('type',30);
            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::create('tbl_quanhuyen', function (Blueprint $table) {
            $table->Increments('maqh')->unsigned();
            $table->String('name_qh',100);
            $table->String('type',30);
            $table->Integer('matp')->index()->unsigned();
            $table->engine = 'InnoDB';
            $table->timestamps();
        });
        Schema::table('tbl_quanhuyen',function (Blueprint $table){
            $table->foreign('matp')->references('matp')->on('tbl_tinhthanhpho');
        });

        Schema::create('tbl_xaphuongthitran', function (Blueprint $table) {
            $table->Increments('xaid');
            $table->String('name_xa',100);
            $table->String('type',30);
            $table->integer('maqh')->index()->unsigned();
            $table->engine = 'InnoDB';
            $table->timestamps();

        });
        Schema::table('tbl_xaphuongthitran',function (Blueprint $table){
            $table->foreign('maqh')->references('maqh')->on('tbl_quanhuyen');
        });

        Schema::create('tbl_deliveryCost', function (Blueprint $table) {
            $table->Increments('delivery_id')->unsigned();
            $table->Integer('delivery_matp')->index()->unsigned();
            $table->Integer('delivery_maqh')->index()->unsigned();
            $table->Integer('delivery_xaid')->index()->unsigned();
            $table->String('delivery_cost');
            $table->engine = 'InnoDB';
            $table->timestamps();
        });
        Schema::table('tbl_deliveryCost',function (Blueprint $table){
            $table->foreign('delivery_matp')->references('matp')->on('tbl_tinhthanhpho');
            $table->foreign('delivery_maqh')->references('maqh')->on('tbl_quanhuyen');
            $table->foreign('delivery_xaid')->references('xaid')->on('tbl_xaphuongthitran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_deliveryCost');
    }
}
