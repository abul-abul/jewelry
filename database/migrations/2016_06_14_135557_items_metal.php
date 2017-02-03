<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ItemsMetal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_metal', function (Blueprint $table){
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->integer('metal_id')->unsigned();
            $table->timestamps();
            $table->foreign('metal_id')
                 ->references('id')
                 ->on('metals')
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
        Schema::drop('items_metal');
    }
}
