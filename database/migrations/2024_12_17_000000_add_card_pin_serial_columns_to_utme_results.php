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
            $table->string('ol1_card_pin')->nullable()->after('ol1_card_file');
            $table->string('ol2_card_pin')->nullable()->after('ol2_card_file');
            $table->string('ol1_serial_number')->nullable()->after('ol1_card_pin');
            $table->string('ol2_serial_number')->nullable()->after('ol2_card_pin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('utme_results', function (Blueprint $table) {
            $table->dropColumn([
                'ol1_card_pin',
                'ol2_card_pin', 
                'ol1_serial_number',
                'ol2_serial_number'
            ]);
        });
    }
};
