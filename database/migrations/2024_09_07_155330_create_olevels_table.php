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
        Schema::create('olevels', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 100)->nullable();
            $table->string('reg_number', 50)->nullable();  // Reduced size
            $table->string('de_reg_number', 50)->nullable();  // Reduced size
            $table->string('olevel1_exam', 100)->nullable();
            $table->string('olevel1_examno', 100)->nullable();
            $table->year('olevel1_examilyear')->nullable();
            $table->string('olevel1_examilyear_t', 10)->nullable();  // Reduced size
            $table->string('olevel1_exammonth', 50)->nullable();
            $table->string('olevel1_exammonth_t', 10)->nullable();  // Reduced size
            $table->string('ol1_result_pin', 100)->nullable();
            $table->string('ol1_result_sno', 100)->nullable();
            $table->string('ol1_s1')->nullable();
            $table->string('ol1_g1')->nullable();
            $table->string('ol1_s2')->nullable();
            $table->string('ol1_g2')->nullable();
            $table->string('ol1_s3')->nullable();
            $table->string('ol1_g3')->nullable();
            $table->string('ol1_s4')->nullable();
            $table->string('ol1_g4')->nullable();
            $table->string('ol1_s5')->nullable();
            $table->string('ol1_g5')->nullable();
            $table->string('ol1_s6')->nullable();
            $table->string('ol1_g6')->nullable();
            $table->string('ol1_s7')->nullable();
            $table->string('ol1_g7')->nullable();
            $table->string('ol1_s8')->nullable();
            $table->string('ol1_g8')->nullable();
            $table->string('ol1_s9')->nullable();
            $table->string('ol1_g9')->nullable();
            $table->string('ol1_s10')->nullable();
            $table->string('ol1_g10')->nullable();
            $table->string('ol1_s11')->nullable();
            $table->string('ol1_g11')->nullable();
            $table->string('ol1_s12')->nullable();
            $table->string('ol1_g12')->nullable();
            $table->string('olevel2_exam')->nullable();
            $table->string('olevel2_examno')->nullable();
            $table->year('olevel2_examilyear')->nullable();
            $table->string('olevel2_examilyear_t')->nullable();
            $table->string('olevel2_exammonth')->nullable();
            $table->string('olevel2_exammonth_t')->nullable();
            $table->string('ol2_result_pin')->nullable();
            $table->string('ol2_result_sno')->nullable();
            $table->string('ol2_s1')->nullable();
            $table->string('ol2_g1')->nullable();
            $table->string('ol2_s2')->nullable();
            $table->string('ol2_g2')->nullable();
            $table->string('ol2_s3')->nullable();
            $table->string('ol2_g3')->nullable();
            $table->string('ol2_s4')->nullable();
            $table->string('ol2_g4')->nullable();
            $table->string('ol2_s5')->nullable();
            $table->string('ol2_g5')->nullable();
            $table->string('ol2_s6')->nullable();
            $table->string('ol2_g6')->nullable();
            $table->string('ol2_s7')->nullable();
            $table->string('ol2_g7')->nullable();
            $table->string('ol2_s8')->nullable();
            $table->string('ol2_g8')->nullable();
            $table->string('ol2_s9')->nullable();
            $table->string('ol2_g9')->nullable();
            $table->string('ol2_s10')->nullable();
            $table->string('ol2_g10')->nullable();
            $table->string('ol2_s11')->nullable();
            $table->string('ol2_g11')->nullable();
            $table->string('ol2_s12')->nullable();
            $table->string('ol2_g12')->nullable();
            $table->timestamp('last_updated')->nullable();
            $table->timestamps();
        

            $table->foreign('reg_number')->references('reg_number')->on('utme_results')->onDelete('cascade');
            $table->foreign('de_reg_number')->references('reg_number')->on('de_results')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('olevels');
    }
};
