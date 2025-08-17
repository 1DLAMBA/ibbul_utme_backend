<?php

namespace App\Imports;

use App\Models\DeResult;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DeResultsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', '300');
        
        // Check for existing record using the new header format
        $regNumber = $row['regnumb'] ?? $row['RG_NUM'] ?? $row['rg_num'] ?? null;
        $existingRecord = DeResult::where('reg_number', $regNumber)->first();
        
        // Log::debug($row);
        
        if ($existingRecord) {
            return null; // Return null to skip inserting a new record
        } else {
        return new DeResult([
           'reg_number' => $regNumber,
                'cand_name' => $row['RG_CANDNAME'] ?? $row['rg_candname'] ?? null,
                'sex' => $row['RG_SEX'] ?? $row['rg_sex'] ?? null,
                'state_of_origin' => $row['STATENAME'] ?? $row['statename'] ?? null,
                'cors_abrev' => $row['CO_NAME'] ?? $row['co_name'] ?? null,
                'lga' => $row['LGA'] ?? $row['lga'] ?? null,
                'is_de_cleared' => $row['IsDECleared'] ?? $row['isdecleared'] ?? null,
            ]);
    }
}
}
