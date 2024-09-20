<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExamGrade;

class ExamGradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $examGrades = [
            ['id' => '1' ,'waec' => 'A1', 'neco' => 'A1', 'nabteb' => 'A1', 'grade2' => 'A', 'nbais' => 'A1'],
            ['id' => '2' ,'waec' => 'B2', 'neco' => 'B2', 'nabteb' => 'A2', 'grade2' => 'B', 'nbais' => 'B2'],
            ['id' => '3' ,'waec' => 'B3', 'neco' => 'B3', 'nabteb' => 'A3', 'grade2' => 'B1', 'nbais' => 'B3'],
            ['id' => '4' ,'waec' => 'C4', 'neco' => 'C4', 'nabteb' => 'C4', 'grade2' => 'B2', 'nbais' => 'C4'],
            ['id' => '5' ,'waec' => 'C5', 'neco' => 'C5', 'nabteb' => 'C5', 'grade2' => 'C', 'nbais' => 'C5'],
            ['id' => '6' ,'waec' => 'C6', 'neco' => 'C6', 'nabteb' => 'C6', 'grade2' => 'D', 'nbais' => 'C6'],
            ['id' => '7' ,'waec' => 'A.R', 'neco' => 'A.R', 'nabteb' => 'A.R', 'grade2' => 'A.R', 'nbais' => 'A.R'],
            ['id' => "0" ,'waec' => ' ', 'neco' => ' ', 'nabteb' => ' ', 'grade2' => ' ', 'nbais' => ' '],
            // Add more data here if needed
        ];

        foreach ($examGrades as $grade) {
            ExamGrade::create($grade);
        }

    }
}
