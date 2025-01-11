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
        Schema::table('projects', function (Blueprint $table) {
          $table->integer('faculty_id')->after('id');
          $table->string('code')->after('commission_id')->nullable();
          $table->string('password')->nullable()->after('code');
          $table->string('pitch_deck')->nullable()->after('bmc');
          $table->enum('archived', ['0', '1'])->default('0')->after('pitch_deck');
          $table->tinyInteger('status')->default(1)->after('archived');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn("faculty_id");
            $table->dropColumn("code");
            $table->dropColumn("password");
            $table->dropColumn("pitch_deck");
            $table->dropColumn("archived");
            $table->dropColumn("status");
        });
    }
};
