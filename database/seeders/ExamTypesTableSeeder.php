<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExamType;

class ExamTypesTableSeeder extends Seeder
{
    public function run()
    {
        $examTypes = [
            ['id' => 1, 'exam_type' => 'WAEC', 'exam_code' => 'W'],
            ['id' => 3, 'exam_type' => 'NECO', 'exam_code' => 'N'],
            ['id' => 6, 'exam_type' => 'NABTEB', 'exam_code' => 'T'],
            ['id' => 7, 'exam_type' => 'GRADE II TEACHERS CERT.', 'exam_code' => 'G'],
            ['id' => 8, 'exam_type' => 'NBAIS', 'exam_code' => 'NB'],
            
        ];

        foreach ($examTypes as $type) {
            ExamType::create($type);
        }
    }
}
