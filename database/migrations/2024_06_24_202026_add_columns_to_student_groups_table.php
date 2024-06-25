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
        Schema::table('student_groups', function (Blueprint $table) {
            $table->string('state_of_birth')->after('birthday')->nullable();
            $table->string('registration_number')->after('state_of_birth')->unique()->nullable();
            $table->string('academicLevel')->after('registration_number')->nullable();
            $table->string('specialty')->after('academicLevel')->nullable();
            $table->string('faculty')->after('specialty')->nullable();
            $table->string('department')->after('faculty')->nullable();
            
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
            //
        });
    }
};
