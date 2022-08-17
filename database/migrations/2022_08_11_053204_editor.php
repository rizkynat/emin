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
        Schema::create('editor', function(Blueprint $table){
            $table->increments('id_editor');
            $table->string('nama_editor');
            $table->string('password');
            $table->string('email_editor');
            $table->enum('role', array('chief editor', 'bendahara', 'author'));
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
