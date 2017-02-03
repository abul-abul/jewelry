<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
       Schema::create('users', function (Blueprint $table) { 
           $table->increments('id');
           $table->string('first_name');
           $table->string('last_name');
           $table->string('image');
           $table->string('email');
           $table->string('password');
           $table->string('activation_token');
           $table->enum('registered_with',['website', 'facebook', 'twitter', 'google']);
           $table->boolean('is_active')->default(0);
           $table->float('balance');
           $table->integer('items_count')->default(0);
           $table->string('country');
           $table->string('city');
           $table->string('address');
           $table->string('postal_code');
           $table->text('phone_number');
           $table->string('facebook_id')->nullable();
           $table->string('twitter_id')->nullable();
           $table->string('google_id')->nullable();
           $table->enum('role', ['user', 'admin'])->default('user');
           $table->rememberToken();
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
       Schema::drop('users');
   }
}