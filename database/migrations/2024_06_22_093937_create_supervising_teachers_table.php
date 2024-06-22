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
        Schema::create('supervising_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            
            $table->string('firstname_fr');
            $table->string('firstname_ar');

            $table->string('lastname_fr');
            $table->string('lastname_ar');
            
            $table->integer('gender');
            
            $table->string('speciality');
            $table->string('faculty');
            $table->string('departement');
            $table->string('grade');
            
            $table->integer('id_student');
            $table->integer('id_project')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supervising_teachers');
    }
};
