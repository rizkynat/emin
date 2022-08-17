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
        Schema::create('keuangan', function(Blueprint $table){
            $table->increments('id_keuangan');
            $table->string('deskripsi');
            $table->enum('status' ,array('Uang keluar', 'Uang masuk'));
            $table->string('foto_kwitansi');
            $table->integer('nominal');
            $table->timestamp('tgl_keuangan');
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
