<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Update_utme_result_Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reg_number' => 'required|string|unique:utme_result,reg_number,' . $this->utme_result->id,
            'dept_sn' => 'required|string',
            'cand_name' => 'required|string',
            'state_of_origin' => 'required|string',
            'lga' => 'required|string',
            'sex' => 'required|string|in:M,F',
            'age' => 'required|integer|min:0',
            'eng_score' => 'required|integer|min:0|max:100',
            'subj2' => 'required|string',
            'subj2_score' => 'required|integer|min:0|max:100',
            'subj3' => 'required|string',
            'subj3_score' => 'required|integer|min:0|max:100',
            'subj4' => 'required|string',
            'subj4_score' => 'required|integer|min:0|max:100',
            'total_score' => 'required|integer|min:0|max:400',
            'most_preferred_inst' => 'required|string',
            'fac_abrev' => 'required|string',
            'cors_abrev' => 'required|string',
            'cors_id' => 'nullable|string',
            'phone_no' => 'nullable|string',
            'no_results' => 'required|boolean',
            'pay_status' => 'required|boolean',
            'gen_date' => 'nullable|date',
            'school_cert_file' => 'required|string',
            'indigene_file' => 'required|string',
            'ol2_card_file' => 'required|string',
            'ol1_card_file' => 'required|string',
            'ol1_card_pin' => 'nullable|string|max:50',
            'ol2_card_pin' => 'nullable|string|max:50',
            'ol1_serial_number' => 'nullable|string|max:50',
            'ol2_serial_number' => 'nullable|string|max:50',
            'ol1_result_file' => 'required|string',
            'ol2_result_file' => 'required|string',
        ];
    }
}
