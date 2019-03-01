<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('students', function (Blueprint $table) {
        $table->integer('SemestresCursados')->default(0)->change();
        $table->integer('AñoTitulación')->default(0)->change();
        $table->integer('PeriodoTitulación')->default(0)->change();
      });


      Schema::table('seguimientos', function (Blueprint $table) {
        $table->date('liberación')->default(null)->change();
        $table->date('solicitudActo')->default(null)->change();
        $table->date('actoProtocolario')->default(null)->change();
        $table->integer('status_id')->unsigned()->default(1)->change();
        $table->longText('observaciones')->default('')->change();

      });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
