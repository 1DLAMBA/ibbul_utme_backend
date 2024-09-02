<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('de_results', function (Blueprint $table) {
            $table->id();
             $table->string('reg_number')->unique();
            $table->string('dept_sn')->nullable();
            $table->string('cand_name')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('lga')->nullable();
            $table->string('sex')->nullable();
            $table->integer('age')->nullable();
            $table->integer('aggregate')->nullable();
            $table->string('fac_abrev')->nullable();
            $table->string('cors_abrev')->nullable();
            $table->string('cors_id')->nullable();
            $table->string('phone_no')->nullable();
            $table->boolean('no_results')->nullable();
            $table->boolean('pay_status')->nullable();
            $table->timestamp('gendate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('de_results');
    }
};
