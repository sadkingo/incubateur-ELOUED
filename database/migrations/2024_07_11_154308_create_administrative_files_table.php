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
        Schema::create('administrative_files', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->nullable();
            $table->integer('student_group_id')->nullable();
            $table->string('registration_certificate');
            $table->string('identification_card');
            $table->string('photo');
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
        Schema::dropIfExists('administrative_files');
    }
};
