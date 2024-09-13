<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CoursesImport;


class DE_course_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Excel::import(new CoursesImport, storage_path('app/ALevel_DropDown_Values.xlsx')); // Adjust the path to your Excel file
    }
}
