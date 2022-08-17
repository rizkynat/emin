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
        Schema::create('artikel_status', function(Blueprint $table){
            $table->increments('id_artikel_status');
            $table->char('kode_status', 15)->unique();
            $table->foreign('kode_status')->references('kode_status')->on('status');
            $table->unsignedInteger('id_artikel');
            $table->foreign('id_artikel')->references('id_artikel')->on('artikel');
            $table->timestamp('tanggal');
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
