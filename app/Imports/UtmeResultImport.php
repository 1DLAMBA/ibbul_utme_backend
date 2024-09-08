<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\utme_result;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UtmeResultImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $genDate = \DateTime::createFromFormat('d/m/Y', $row['gendate']);
        $formattedDate = $genDate ? $genDate->format('Y-m-d H:i:s') : null;
        $existingRecord = utme_result::where('reg_number', $row['regnumb'])->first();

        if ($existingRecord) {
            
            return null; // Return null to skip inserting a new record
        } else {
            return new utme_result([
                'reg_number' => $row['regnumb'], // Map Excel 'REGNUMBER' to 'reg_number'
                'cand_name' => $row['candname'], //x Map Excel 'CANDNAME' to 'cand_name'
                'dept_sn' => $row['deptsn'],
                'state_of_origin' => $row['stateoforigin'],
                'lga' => $row['lga'],
                'sex' => $row['sex'],
                'age' => $row['age'],
                'eng_score' => $row['engscore'] ?? null,
                'subj2' => $row['subj2']  ?? null,
                'subj2_score' => $row['subj2score']  ?? null,
                'subj3' => $row['subj3']  ?? null,
                'subj3_score' => $row['subj3score']  ?? null,
                'subj4' => $row['subj4'] ?? null,
                'subj4_score' => $row['subj4score'] ?? null,
                'total_score' => $row['totalscore'] ?? null,
                'most_preferred_inst' => $row['mostpreferinst'] ?? null,
                'fac_abrev' => $row['facabrev'] ?? null,
                'cors_abrev' => $row['corsabrev'] ?? null,
                'aggregate' => $row['aggregate'] ?? null,
                'cors_id' => $row['corsid'] ?? null,
                'phone_no' => $row['phoneno'],
                'no_results' => $row['noresults'],
                'pay_status' => $row['paystatus'],
                'gen_date' => $formattedDate,
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 1000; // Process 1000 rows at a time
    }
}
