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
        Schema::create('pembayaran', function(Blueprint $table){
            $table->increments('id_bayar');
            $table->unsignedInteger('id_invoice');
            $table->foreign('id_invoice')->references('id_invoice')->on('invoice');
            $table->string('nama_pengirim');
            $table->string('bukti_bayar');
            $table->timestamp('tgl_invoice');
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
