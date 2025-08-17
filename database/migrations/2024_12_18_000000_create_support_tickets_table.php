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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('topic');
            $table->string('portal_type');
            $table->string('status')->default('pending');
            $table->string('student_name')->nullable();
            $table->string('reg_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            
            // Topic-specific details stored as JSON
            $table->json('details')->nullable();
            
            // Admin management fields
            $table->text('admin_response')->nullable();
            $table->text('resolution_notes')->nullable();
            $table->string('assigned_to')->nullable();
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->nullable();
            $table->string('estimated_resolution_time')->nullable();
            
            // Timestamps
            $table->timestamp('timestamp');
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['topic', 'status']);
            $table->index(['portal_type', 'status']);
            $table->index('reg_number');
            $table->index('timestamp');
            $table->index('priority');
            $table->index('assigned_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
