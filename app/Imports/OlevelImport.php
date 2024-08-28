<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Olevel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OlevelImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        
        $existingRecord = Olevel::where('reg_number', $row['regnumb'])->first();

        if ($existingRecord) {
            
            return null; // Return null to skip inserting a new record
        } else {
            return new Olevel([
                'uid' => $row['uid'] ?? null,
            'reg_number' => $row['regnumb'] ?? null,
            'olevel1_exam' => $row['olevel1_exam'] ?? null,
            'olevel1_examno' => $row['olevel1_examno'] ?? null,
            'olevel1_examyear' => $row['olevel1_examyear'] ?? null,
            'olevel1_examyear_t' => $row['olevel1_examyear_t'] ?? null,
            'olevel1_exammonth' => $row['olevel1_exammonth'] ?? null,
            'olevel1_exammonth_t' => $row['olevel1_exammonth_t'] ?? null,
            'ol1_result_pin' => $row['ol1_result_pin'] ?? null,
            'ol1_result_sno' => $row['ol1_result_sno'] ?? null,
            'ol1_s1' => $row['ol1_s1'] ?? null,
            'ol1_g1' => $row['ol1_g1'] ?? null,
            'ol1_s2' => $row['ol1_s2'] ?? null,
            'ol1_g2' => $row['ol1_g2'] ?? null,
            'ol1_s3' => $row['ol1_s3'] ?? null,
            'ol1_g3' => $row['ol1_g3'] ?? null,
            'ol1_s4' => $row['ol1_s4'] ?? null,
            'ol1_g4' => $row['ol1_g4'] ?? null,
            'ol1_s5' => $row['ol1_s5'] ?? null,
            'ol1_g5' => $row['ol1_g5'] ?? null,
            'ol1_s6' => $row['ol1_s6'] ?? null,
            'ol1_g6' => $row['ol1_g6'] ?? null,
            'ol1_s7' => $row['ol1_s7'] ?? null,
            'ol1_g7' => $row['ol1_g7'] ?? null,
            'ol1_s8' => $row['ol1_s8'] ?? null,
            'ol1_g8' => $row['ol1_g8'] ?? null,
            'ol1_s9' => $row['ol1_s9'] ?? null,
            'ol1_g9' => $row['ol1_g9'] ?? null,
            'ol1_s10' => $row['ol1_s10'] ?? null,
            'ol1_g10' => $row['ol1_g10'] ?? null,
            'ol1_s11' => $row['ol1_s11'] ?? null,
            'ol1_g11' => $row['ol1_g11'] ?? null,
            'ol1_s12' => $row['ol1_s12'] ?? null,
            'ol1_g12' => $row['ol1_g12'] ?? null,
            'olevel2_exam' => $row['olevel2_exam'] ?? null,
            'olevel2_examno' => $row['olevel2_examno'] ?? null,
            'olevel2_examyear' => $row['olevel2_examyear'] ?? null,
            'olevel2_examyear_t' => $row['olevel2_examyear_t'] ?? null,
            'olevel2_exammonth' => $row['olevel2_exammonth'] ?? null,
            'olevel2_exammonth_t' => $row['olevel2_exammonth_t'] ?? null,
            'ol2_result_pin' => $row['ol2_result_pin'] ?? null,
            'ol2_result_sno' => $row['ol2_result_sno'] ?? null,
            'ol2_s1' => $row['ol2_s1'] ?? null,
            'ol2_g1' => $row['ol2_g1'] ?? null,
            'ol2_s2' => $row['ol2_s2'] ?? null,
            'ol2_g2' => $row['ol2_g2'] ?? null,
            'ol2_s3' => $row['ol2_s3'] ?? null,
            'ol2_g3' => $row['ol2_g3'] ?? null,
            'ol2_s4' => $row['ol2_s4'] ?? null,
            'ol2_g4' => $row['ol2_g4'] ?? null,
            'ol2_s5' => $row['ol2_s5'] ?? null,
            'ol2_g5' => $row['ol2_g5'] ?? null,
            'ol2_s6' => $row['ol2_s6'] ?? null,
            'ol2_g6' => $row['ol2_g6'] ?? null,
            'ol2_s7' => $row['ol2_s7'] ?? null,
            'ol2_g7' => $row['ol2_g7'] ?? null,
            'ol2_s8' => $row['ol2_s8'] ?? null,
            'ol2_g8' => $row['ol2_g8'] ?? null,
            'ol2_s9' => $row['ol2_s9'] ?? null,
            'ol2_g9' => $row['ol2_g9'] ?? null,
            'ol2_s10' => $row['ol2_s10'] ?? null,
            'ol2_g10' => $row['ol2_g10'] ?? null,
            'ol2_s11' => $row['ol2_s11'] ?? null,
            'ol2_g11' => $row['ol2_g11'] ?? null,
            'ol2_s12' => $row['ol2_s12'] ?? null,
            'ol2_g12' => $row['ol2_g12'] ?? null,
            'last_updated' => $row['last_updated'] ?? null,
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 1000; // Process 1000 rows at a time
    }
}
