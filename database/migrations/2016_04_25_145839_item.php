<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Item extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->char('subtitle');
            $table->text('description');
            $table->string('status');
            $table->integer('main_image_id')->unsigned();
            $table->integer('price');
            $table->integer('new_price');
            $table->float('discount');
            $table->integer('quantity')->unsigned();
            $table->integer('collection_id')->unsigned();
            $table->integer('favorite_img');
            $table->integer('category_id')->unsigned();
            $table->integer('rating');
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
        Schema::drop('items');
    }
}
