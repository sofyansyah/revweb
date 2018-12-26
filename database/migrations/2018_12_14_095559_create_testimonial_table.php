<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonial', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('judul');
            $table->string('lokasi');
            $table->string('nama_tempat');
            $table->integer('rating_tempat');
            $table->string('nama_menu');
            $table->integer('rating_menu');
            $table->string('foto_crop');
            $table->string('foto_normal');
            $table->string('deskripsi');
            $table->string('tag');


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
        Schema::dropIfExists('testimonial');
    }
}
