<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('NoControl');
            $table->string('Nombre');
            $table->string('Apellidos');
            $table->string('Correo');
            $table->integer('AñoIngreso');
            $table->integer('PeriodoIngreso');
            $table->integer('AñoTitulación');
            $table->integer('PeriodoTitulación');
            $table->char('Sexo');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
