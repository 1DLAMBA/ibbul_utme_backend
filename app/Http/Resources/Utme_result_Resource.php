<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Utme_result_Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'reg_number' => $this->reg_number,
            'dept_sn' => $this->dept_sn,
            'cand_name' => $this->cand_name,
            'state_of_origin' => $this->state_of_origin,
            'lga' => $this->lga,
            'sex' => $this->sex,
            'age' => $this->age,
            'eng_score' => $this->eng_score,
            'subj2' => $this->subj2,
            'subj2_score' => $this->subj2_score,
            'subj3' => $this->subj3,
            'subj3_score' => $this->subj3_score,
            'subj4' => $this->subj4,
            'subj4_score' => $this->subj4_score,
            'total_score' => $this->total_score,
            'most_preferred_inst' => $this->most_preferred_inst,
            'fac_abrev' => $this->fac_abrev,
            'cors_abrev' => $this->cors_abrev,
            'cors_id' => $this->cors_id,
            'phone_no' => $this->phone_no,
            'no_results' => $this->no_results,
            'pay_status' => $this->pay_status,
            'gen_date' => $this->gen_date,
            'nin_file' => $this->nin_file,
            'school_cert_file' => $this->school_cert_file,
            'indigene_file' => $this->indigene_file,
            'ol2_card_file' => $this->ol2_card_file,
            'ol1_card_file' => $this->ol1_card_file,
            'ol2_result_file' => $this->ol2_result_file,
            'ol1_result_file' => $this->ol1_result_file,
            // 'results' => ResultResource::collection($this->whenLoaded('results')),
        ];
    }
}
