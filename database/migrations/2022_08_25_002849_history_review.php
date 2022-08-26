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
        Schema::create('history_review', function(Blueprint $table){
            $table->increments('id_history_review');
            $table->unsignedInteger('id_review');
            $table->foreign('id_review')->references('id_review')->on('review');
            $table->string('isi_history');
            $table->timestamp('tgl_history');
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
