<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\utme_result;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UtmeResultImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if($row['gendate']){

            $genDate = \DateTime::createFromFormat('d/m/Y', $row['gendate']);
            $formattedDate = $genDate ? $genDate->format('Y-m-d H:i:s') : null;
        }

        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', '300');
        $existingRecord = utme_result::where('reg_number', $row['regnumb'] or $row['RG_NUM'])->first();
        Log::debug($row);

        if ($existingRecord) {
            
            return null; // Return null to skip inserting a new record
        } else {
            return new utme_result([
                'reg_number' => $row['regnumb'] or $row['RG_NUM'] ?? null, // Map Excel 'REGNUMBER' to 'reg_number'
                'cand_name' => $row['candname'] ?? $row['RG_CANDNAME'] ?? null, //x Map Excel 'CANDNAME' to 'cand_name'
                'dept_sn' => $row['deptsn'] ?? null,
                'state_of_origin' => $row['stateoforigin'] ?? $row['STATE_NAME'] ?? null,
                'lga' => $row['lga'] ?? $row['LGA_NAME'] ,
                'sex' => $row['sex'] ?? $row['RG_SEX'] ?? null,
                'age' => $row['age'] ?? null,
                'eng_score' => $row['engscore'] ?? $row['EngScore'] ?? null,
                'subj2' => $row['subj2']  ?? $row['Subject1'] ?? null,
                'subj2_score' => $row['subj2score']  ?? $row['RG_Sub1Score'] ?? null,
                'subj3' => $row['subj3'] ?? $row['Subject2'] ?? null,
                'subj3_score' => $row['subj3score']  ?? $row['RG_Sub2Score'] ?? null,
                'subj4' => $row['subj4'] ?? $row['Subject3'] ?? null,
                'subj4_score' => $row['subj4score'] ?? $row['RG_Sub3Score'] ?? null,
                'total_score' => $row['totalscore'] ?? $row['RG_AGGREGATE'] ?? null,
                'most_preferred_inst' => $row['mostpreferinst'] ?? null,
                'fac_abrev' => $row['facabrev'] ?? null,
                'cors_abrev' => $row['corsabrev'] ?? $row['CO_NAME'] ?? null,
                'aggregate' => $row['aggregate'] ?? null,
                'cors_id' => $row['corsid'] ?? null,
                'phone_no' => $row['phoneno'] ?? null,
                'no_results' => $row['noresults'] ?? null,
                'pay_status' => $row['paystatus'] ?? null,
                // 'gen_date' => $formattedDate ?? null,
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 1000; // Process 1000 rows at a time
    }
}
