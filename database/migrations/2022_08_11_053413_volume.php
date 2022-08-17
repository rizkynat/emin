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
        Schema::create('volume', function(Blueprint $table){
            $table->increments('id_volume');
            $table->unsignedInteger('id_bank');
            $table->foreign('id_bank')->references('id_bank')->on('bank');
            $table->year('tahun');
            $table->string('no_volume');
            $table->integer('harga');
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
