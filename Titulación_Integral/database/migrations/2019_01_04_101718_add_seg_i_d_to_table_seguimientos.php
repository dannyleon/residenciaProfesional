<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSegIDToTableSeguimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('seguimientos', function($table) {
      $table->integer('seg_id')->after('student_id');
  });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('seguimientos', function($table) {
      $table->dropColumn('seg_id');
  });
    }
}
