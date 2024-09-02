<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

use Illuminate\Http\Resources\Json\JsonResource;

class DeResultResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'dept_sn' => $this->dept_sn,
            'reg_number' => $this->reg_number,
            'cand_name' => $this->cand_name,
            'state_of_origin' => $this->state_of_origin,
            'lga' => $this->lga,
            'sex' => $this->sex,
            'age' => $this->age,
            'aggregate' => $this->aggregate,
            'fac_abrev' => $this->fac_abrev,
            'cors_abrev' => $this->cors_abrev,
            'cors_id' => $this->cors_id,
            'phone_no' => $this->phone_no,
            'no_results' => $this->no_results,
            'pay_status' => $this->pay_status,
            'gendate' => $this->gendate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
