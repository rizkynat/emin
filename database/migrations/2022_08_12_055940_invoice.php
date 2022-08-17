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
        Schema::create('invoice', function(Blueprint $table){
            $table->increments('id_invoice');
            $table->unsignedInteger('id_artikel');
            $table->foreign('id_artikel')->references('id_artikel')->on('artikel');
            $table->string('no_invoice');
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
