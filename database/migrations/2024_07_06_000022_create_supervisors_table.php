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
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('surname_ar');
            $table->string('name_fr');
            $table->string('surname_fr');
            $table->enum('gender', [1, 2]);
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('specialization');
            $table->string('faculty');
            $table->string('department');
            $table->string('rank');
            $table->enum('supervision_role', ['main', 'secondary', 'assistant']);
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
        Schema::dropIfExists('supervisors');
    }
};
