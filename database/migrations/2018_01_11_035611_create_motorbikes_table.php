<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotorbikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motorbikes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('license_plates')->unique();
            $table->string('number_chassis')->unique();
            $table->string('number_engine')->unique();
            $table->string('color');
            $table->integer('capacity');
            $table->integer('status')->default(0);
            $table->integer('is_full_certificate')->default(0);
            $table->integer('id_register');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motorbikes');
    }
}
