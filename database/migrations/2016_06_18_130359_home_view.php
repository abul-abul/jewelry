<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HomeView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_view', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status',['Collections', 'Newsletter', 'New Arrivals', 'Event', 'Featured Items']);
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
       Schema::drop('home_view');
    }
}
