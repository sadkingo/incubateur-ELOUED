<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('student_groups', function (Blueprint $table) {
      $table->integer('student_id')->after('id');
      $table->integer('project_id')->after('student_id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('student_groups', function (Blueprint $table) {
      $table->dropColumn('student_id');
      $table->dropColumn('project_id');
    });
  }
};
