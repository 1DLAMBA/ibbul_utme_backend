<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('alevel_records', function (Blueprint $table) {
            //
            $table->string('mj0')->nullable();
            $table->string('mj0_grade')->nullable();
            $table->string('mj1')->nullable();
            $table->string('mj1_grade')->nullable();
            $table->string('mj2')->nullable();
            $table->string('mj2_grade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alevel_records', function (Blueprint $table) {
            //
        });
    }
};
