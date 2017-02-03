<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShoppingCard extends Migration
{
    /**
      * Run the migrations.
      *
      * @return void
      */
    public function up()
    {
        Schema::create('shopping_card', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->integer('size')->default(0);
            $table->string('user_ip');
            $table->enum('status', ['ordered', 'not_ordered'])->default('not_ordered');
            $table->boolean('order')->default(1);
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
        Schema::drop('shopping_card');
    }
}
