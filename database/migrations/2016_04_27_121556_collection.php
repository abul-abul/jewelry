<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Collection extends Migration
{
    /**
      * Run the migrations.
      *
      * @return void
      */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
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
        Schema::drop('collections');
    }
}
