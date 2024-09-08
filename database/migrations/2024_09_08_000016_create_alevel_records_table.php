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
            $table->string('institution_name');
            $table->string('candidate_name');
            $table->year('year_of_issue');
            $table->string('course'); // Course column
            $table->string('class_of_graduation'); // Class of graduation column
            $table->string('result_type'); // Class of graduation column

            // 4 Subjects and respective grades
            $table->string('subject1');
            $table->string('subject1_grade');
            $table->string('subject2');
            $table->string('subject2_grade');
            $table->string('subject3');
            $table->string('subject3_grade');
            $table->string('subject4');
            $table->string('subject4_grade');
            
            $table->timestamps();
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
