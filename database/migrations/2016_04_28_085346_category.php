<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Category extends Migration
{
    /**
      * Run the migrations.
      *
      * @return void
      */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->text('category');
            $table->string('video');
            $table->string('image');
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
        Schema::drop('categories');
    }
}
