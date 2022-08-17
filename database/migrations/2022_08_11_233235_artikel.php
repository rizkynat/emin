<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikel', function(Blueprint $table){
            $table->increments('id_artikel');
            $table->unsignedInteger('id_volume');
            $table->foreign('id_volume')->references('id_volume')->on('volume');
            $table->string('nama_penulis');
            $table->string('email_penulis');
            $table->string('judul_artikel');
            $table->string('instansi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
