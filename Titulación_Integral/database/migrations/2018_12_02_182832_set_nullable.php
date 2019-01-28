<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seguimientos', function (Blueprint $table) {
            $table->date('liberación')->nullable()->change();
            $table->date('solicitudActo')->nullable()->change();
            $table->date('actoProtocolario')->nullable()->change();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seguimientos', function (Blueprint $table) {
            //
        });
    }
}
