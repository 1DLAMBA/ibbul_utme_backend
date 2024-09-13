<?php

namespace App\Imports;

use App\Models\Institution;
use Maatwebsite\Excel\Concerns\ToModel;

class InstitutionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Log::debug($row);
        return new Institution([
            'name'  => $row[1], // Adjust based on the structure of your Excel sheet
           
        ]);
    }
}
