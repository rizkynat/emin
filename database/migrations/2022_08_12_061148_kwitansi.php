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
        Schema::create('kwitansi', function(Blueprint $table){
            $table->increments('id_kwitansi');
            $table->unsignedInteger('id_bayar');
            $table->foreign('id_bayar')->references('id_bayar')->on('pembayaran');
            $table->string('no_kwitansi');
            $table->timestamp('tgl_kwitansi');
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
