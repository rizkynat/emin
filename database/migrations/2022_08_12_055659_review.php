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
        Schema::create('review', function(Blueprint $table){
            $table->increments('id_review');
            $table->unsignedInteger('id_reviewer');
            $table->foreign('id_reviewer')->references('id_reviewer')->on('reviewer');
            $table->unsignedInteger('id_artikel');
            $table->foreign('id_artikel')->references('id_artikel')->on('artikel');
            $table->enum('catatan', array('Review','Re-Submit For Review','Accepted'));
            $table->timestamp('tgl_review');
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
