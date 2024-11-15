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
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faculty_id');
            $table->string('firstname_ar'); // Firstname in Arabic
            $table->string('lastname_ar');  // Lastname in Arabic
            $table->string('phone')->unique(); // Phone number, must be unique
            $table->string('email')->unique(); // Email, must be unique
            $table->string('password'); // Hashed password

            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');

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
        Schema::dropIfExists('managers');
    }
};
