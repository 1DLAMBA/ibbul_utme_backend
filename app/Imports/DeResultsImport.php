<?php

namespace App\Imports;

use App\Models\DeResult;
use Maatwebsite\Excel\Concerns\ToModel;

class DeResultsImport implements ToModel
{
    public function model(array $row)
    {
        $genDate = \DateTime::createFromFormat('d/m/Y', $row['gendate']);
        $formattedDate = $genDate ? $genDate->format('Y-m-d H:i:s') : null;
        $existingRecord = DeResult::where('reg_number', $row['regnumb'])->first();

        if ($existingRecord) {
            
            return null; // Return null to skip inserting a new record
        } else {
        return new DeResult([
            'reg_number' => $row['regnumb'], // Map Excel 'REGNUMBER' to 'reg_number'
            'cand_name' => $row['candname'], //x Map Excel 'CANDNAME' to 'cand_name'
            'dept_sn' => $row['deptsn'],
            'state_of_origin' => $row['stateoforigin'],
            'lga' => $row['lga'],
            'sex' => $row['sex'],
            'age' => $row['age'],
            'aggregate' => $row[7],
            'fac_abrev' => $row['facabrev'],
            'cors_abrev' => $row['corsabrev'],
            'cors_id' => $row['corsid'],
            'phone_no' => $row['phoneno'],
            'no_results' => $row['noresults'],
            'pay_status' => $row['paystatus'],
            'gendate' => $formattedDate,
        ]);
    }
}
}
