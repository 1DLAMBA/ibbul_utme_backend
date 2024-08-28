<?php

namespace Database\Seeders;

use App\Models\ExamCourse;
use Illuminate\Database\Seeder;

class ExamCourseTableSeeder extends Seeder
{
    public function run()
    {
        ExamCourse::truncate();
  
            $data = [
                ['id' => 1, 'name' => 'English'],
                ['id' => 2, 'name' => 'Mathematics'],
                ['id' => 3, 'name' => 'Geography'],
                ['id' => 4, 'name' => 'Economics'],
                ['id' => 5, 'name' => 'Biology'],
                ['id' => 6, 'name' => 'Physics'],
                ['id' => 7, 'name' => 'Technical Drawing'],
                ['id' => 8, 'name' => 'Chemistry'],
                ['id' => 9, 'name' => 'Agricultural Science'],
                ['id' => 10, 'name' => 'Commerce'],
                ['id' => 11, 'name' => 'CRK'],
                ['id' => 12, 'name' => 'IRK'],
                ['id' => 13, 'name' => 'History'],
                ['id' => 14, 'name' => 'Accounting'],
                ['id' => 15, 'name' => 'Government'],
                ['id' => 16, 'name' => 'Fine Arts'],
                ['id' => 17, 'name' => 'Class Teaching'],
                ['id' => 18, 'name' => 'Education'],
                ['id' => 19, 'name' => 'Int Science'],
                ['id' => 20, 'name' => 'Social Studies'],
                ['id' => 21, 'name' => 'P.H.E.'],
                ['id' => 23, 'name' => 'Intro to Building Construction'],
                ['id' => 24, 'name' => 'Brick Laying and Block Laying'],
                ['id' => 25, 'name' => 'Concreating'],
                ['id' => 26, 'name' => 'Walls, Floors and Ceeling Finishing'],
                ['id' => 27, 'name' => 'Hausa Language'],
                ['id' => 28, 'name' => 'Hausa Literature'],
                ['id' => 29, 'name' => 'Visual Arts'],
                ['id' => 30, 'name' => 'Motor Vehicle M. Works'],
                ['id' => 31, 'name' => 'Information And Communication Tech.'],
                ['id' => 32, 'name' => 'General Metal Work'],
                ['id' => 33, 'name' => 'Building And Engineering Drawing'],
                ['id' => 34, 'name' => 'Health Science'],
                ['id' => 35, 'name' => 'Basic Electricity'],
                ['id' => 36, 'name' => 'Domestic And Industrial Installation'],
                ['id' => 37, 'name' => 'Winding Of Electrical Machine'],
                ['id' => 38, 'name' => 'Cable Joint And Battery Charge'],
                ['id' => 39, 'name' => 'English Literature'],
                ['id' => 40, 'name' => 'Home Economics'],
                ['id' => 41, 'name' => 'Home Management'],
                ['id' => 42, 'name' => 'Food And Nutrition'],
                ['id' => 43, 'name' => 'Office Practice'],
                ['id' => 44, 'name' => 'Radio Communication'],
                ['id' => 45, 'name' => 'Television'],
                ['id' => 46, 'name' => 'Further Mathematics'],
                ['id' => 47, 'name' => 'Electronic Device and Circuit'],
                ['id' => 48, 'name' => 'Fitting, Drilling and Grinding'],
                ['id' => 49, 'name' => 'Turning, Milling, Shaping, Planning, and Slotting'],
                ['id' => 50, 'name' => 'Arabic Language'],
                ['id' => 51, 'name' => 'Short Hand'],
                ['id' => 52, 'name' => 'Typewriting'],
                ['id' => 53, 'name' => 'Book Keeping'],
                ['id' => 54, 'name' => 'Mechanical Engineering Craft Practice'],
                ['id' => 55, 'name' => 'Wood Work'],
                ['id' => 56, 'name' => 'Electrical Installation and maintenance'],
                ['id' => 58, 'name' => 'Yoruba Language'],
                ['id' => 59, 'name' => 'Igbo Language'],
                ['id' => 61, 'name' => 'French'],
                ['id' => 62, 'name' => 'Civic Education'],
                ['id' => 63, 'name' => 'Computer Studies'],
                ['id' => 64, 'name' => 'Animal Husbandry'],
                ['id' => 65, 'name' => 'Marketing'],
                ['id' => 66, 'name' => 'Music'],
                ['id' => 67, 'name' => 'Fishery'],
        ];

        foreach ($data as $examCourseData) {
            ExamCourse::create($examCourseData);
        }
    }
}
