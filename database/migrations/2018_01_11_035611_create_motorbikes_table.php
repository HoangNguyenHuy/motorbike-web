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
            $table->string('name');
            $table->string('license_plates')->unique(); // biển số xe
            $table->string('number_chassis')->unique(); // số khung
            $table->string('number_engine')->unique(); // số máy
            $table->string('color');
            $table->integer('capacity'); // dung tích si lanh
            $table->integer('status')->default(0);
            $table->integer('type_id')->default(0); // id loại xe
            $table->integer('is_full_certificate')->default(0); // đầy đủ giấy tờ
            $table->integer('id_register')->default(0); // số giấy đăng ký
            $table->integer('thumbnail'); // ảnh mô tả
            $table->integer('price');
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
