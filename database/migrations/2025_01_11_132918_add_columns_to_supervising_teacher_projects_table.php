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
    Schema::table('supervising_teacher_projects', function (Blueprint $table) {
      $table->integer('faculty_id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('supervising_teacher_projects', function (Blueprint $table) {
      $table->dropColumn("faculty_id");
    });
  }
};
