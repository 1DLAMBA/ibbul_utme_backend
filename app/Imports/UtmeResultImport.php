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
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', '300');
        
        // Check for existing record using the new header format
        $regNumber = $row['regnumb'] ?? $row['RG_NUM'] ?? $row['rg_num'] ?? null;
        $existingRecord = utme_result::where('reg_number', $regNumber)->first();
        
        Log::debug($row);
        
        if ($existingRecord) {
            return null; // Return null to skip inserting a new record
        } else {
            return new utme_result([
                'reg_number' => $regNumber,
                'cand_name' => $row['candname'] ?? $row['RG_CANDNAME'] ?? $row['rg_candname'] ?? null,
                'dept_sn' => $row['deptsn'] ?? null,
                'state_of_origin' => $row['stateoforigin'] ?? $row['STATE_NAME'] ?? $row['state_name'] ?? null,
                'lga' => $row['lga'] ?? $row['LGA_NAME'] ?? $row['lga_name'] ?? null,
                'sex' => $row['sex'] ?? $row['RG_SEX'] ?? $row['rg_sex'] ?? null,
                'age' => $row['age'] ?? null,
                'eng_score' => $row['engscore'] ?? $row['EngScore'] ?? $row['engscore'] ?? null,
                'subj2' => $row['subj2'] ?? $row['Subject1'] ?? $row['subject1'] ?? null,
                'subj2_score' => $row['subj2score'] ?? $row['RG_Sub1Score'] ?? $row['rg_sub1score'] ?? null,
                'subj3' => $row['subj3'] ?? $row['Subject2'] ?? $row['subject2'] ?? null,
                'subj3_score' => $row['subj3score'] ?? $row['RG_Sub2Score'] ?? $row['rg_sub2score'] ?? null,
                'subj4' => $row['subj4'] ?? $row['Subject3'] ?? $row['subject3'] ?? null,
                'subj4_score' => $row['subj4score'] ?? $row['RG_Sub3Score'] ?? $row['rg_sub3score'] ?? null,
                'total_score' => $row['totalscore'] ?? $row['RG_AGGREGATE'] ?? $row['rg_aggregate'] ?? null,
                'most_preferred_inst' => $row['mostpreferinst'] ?? null,
                'fac_abrev' => $row['facabrev'] ?? null,
                'cors_abrev' => $row['corsabrev'] ?? $row['CO_NAME'] ?? $row['co_name'] ?? null,
                'aggregate' => $row['aggregate'] ?? null,
                'cors_id' => $row['corsid'] ?? null,
                'phone_no' => $row['phoneno'] ?? null,
                'no_results' => $row['noresults'] ?? null,
                'pay_status' => $row['paystatus'] ?? null,
                // Note: Subject4 header exists but no corresponding RG_Sub4Score in your headers
                // If you need to handle Subject4, you might need to check if there's a fourth subject score column
            ]);
        }
    }
    
    public function chunkSize(): int
    {
        return 1000; // Process 1000 rows at a time
    }
}