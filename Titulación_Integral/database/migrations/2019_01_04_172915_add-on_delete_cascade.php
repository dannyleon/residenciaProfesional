<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnDeleteCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seguimientos', function (Blueprint $table) {

          $table->dropForeign(['student_id']);

          $table->foreign('student_id')
          ->references('id')
          ->on('students')
          ->onDelete('cascade');

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
