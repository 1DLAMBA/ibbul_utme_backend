<?php

namespace App\Imports;

use App\Models\Course;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;

class CoursesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Log::debug($row);
        return new Course([
            'name'  => $row[0], // Adjust based on the structure of your Excel sheet
            'level'  => ' ', // Adjust based on the structure of your Excel sheet
        ]);
    }
}
