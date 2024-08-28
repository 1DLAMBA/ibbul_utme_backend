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
        Schema::table('utme_results', function (Blueprint $table) {
            $table->string('ol1_result_file')->nullable();
            $table->string('ol2_result_file')->nullable();
            $table->string('ol1_card_file')->nullable();
            $table->string('ol2_card_file')->nullable();
            $table->string('indigene_file')->nullable();
            $table->string('school_cert_file')->nullable();
            $table->string('nin_file')->nullable();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
