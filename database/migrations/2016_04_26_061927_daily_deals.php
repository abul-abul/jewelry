<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DailyDeals extends Migration
{
    /**
      * Run the migrations.
      *
      * @return void
      */
    public function up()
    {
        Schema::create('daily_deals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->datetime('expires_at');
            $table->integer('priority')->unsigned();
        });
    }

    /**
      * Reverse the migrations.
      *
      * @return void
      */
    public function down()
    {
        Schema::drop('daily_deals');
    }
}
