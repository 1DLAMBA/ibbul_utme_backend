<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlevelRecordsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alevel_records', function (Blueprint $table) {
            $table->id();
            $table->string('institution_name')->nullable();
            $table->string('candidate_name')->nullable();
            $table->year('year_of_issue')->nullable();
            $table->string('course')->nullable(); // Course column
            $table->string('class_of_graduation')->nullable(); // Class of graduation column
            $table->string('result_type')->nullable(); // Class of graduation column

            // 4 Subjects and respective grades
            $table->string('reg_number', 50)->nullable();  // Reduced size

            $table->string('subject1')->nullable();
            $table->string('subject1_grade')->nullable();
            $table->string('subject2')->nullable();
            $table->string('subject2_grade')->nullable();
            $table->string('subject3')->nullable();
            $table->string('subject3_grade')->nullable();
            $table->string('subject4')->nullable();
            $table->string('subject4_grade')->nullable();
            
            $table->timestamps();

            $table->foreign('reg_number')->references('reg_number')->on('utme_results')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alevel_records');
    }
}
