<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowUp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('metodo_id')->unsigned();
            $table->date('autRegistro');
            $table->date('recibido');
            $table->date('liberación');
            $table->date('solicitudActo');
            $table->date('actoProtocolario');
            $table->integer('status')->unsigned();
            $table->integer('student_id')->unsigned();

            $table->timestamps();

            $table->foreign('metodo_id')->references('id')->on('metodos');
            $table->foreign('status')->references('id')->on('status');
            $table->foreign('student_id')->references('id')->on('students');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguimientos');
    }
}
