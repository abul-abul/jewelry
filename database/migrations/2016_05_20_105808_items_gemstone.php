<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ItemsGemstone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_gemstone', function (Blueprint $table){
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->integer('gemstone_id')->unsigned();
            $table->timestamps();
            $table->foreign('gemstone_id')
                 ->references('id')
                 ->on('gemstones')
                 ->onDelete('cascade');
            $table->foreign('item_id')
                 ->references('id')
                 ->on('items')
                 ->onDelete('cascade');     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items_gemstone');
    }
}
