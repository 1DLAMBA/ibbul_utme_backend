<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Update_olevel_Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'uid' => 'nullable',
            'reg_number' => 'nullable',
            'olevel1_exam' => 'nullable',
            'olevel1_examno' => 'nullable',
            'olevel1_examilyear' => 'nullable|integer',
            'olevel1_examilyear_t' => 'nullable',
            'olevel1_exammonth' => 'nullable',
            'olevel1_exammonth_t' => 'nullable',
            'ol1_result_pin' => 'nullable',
            'ol1_result_sno' => 'nullable',
            'ol1_s1' => 'nullable',
            'ol1_g1' => 'nullable',
            'ol1_s2' => 'nullable',
            'ol1_g2' => 'nullable',
            'ol1_s3' => 'nullable',
            'ol1_g3' => 'nullable',
            'ol1_s4' => 'nullable',
            'ol1_g4' => 'nullable',
            'ol1_s5' => 'nullable',
            'ol1_g5' => 'nullable',
            'ol1_s6' => 'nullable',
            'ol1_g6' => 'nullable',
            'ol1_s7' => 'nullable',
            'ol1_g7' => 'nullable',
            'ol1_s8' => 'nullable',
            'ol1_g8' => 'nullable',
            'ol1_s9' => 'nullable',
            'ol1_g9' => 'nullable',
            'ol1_s10' => 'nullable',
            'ol1_g10' => 'nullable',
            'ol1_s11' => 'nullable',
            'ol1_g11' => 'nullable',
            'ol1_s12' => 'nullable',
            'ol1_g12' => 'nullable',
            'olevel2_exam' => 'nullable',
            'olevel2_examno' => 'nullable',
            'olevel2_examyear' => 'nullable|integer',
            'olevel2_examilyear_t' => 'nullable',
            'olevel2_exammonth' => 'nullable',
            'olevel2_exammonth_t' => 'nullable',
            'ol2_result_pin' => 'nullable',
            'ol2_result_sno' => 'nullable',
            'ol2_s1' => 'nullable',
            'ol2_g1' => 'nullable',
            'ol2_s2' => 'nullable',
            'ol2_g2' => 'nullable',
            'ol2_s3' => 'nullable',
            'ol2_g3' => 'nullable',
            'ol2_s4' => 'nullable',
            'ol2_g4' => 'nullable',
            'ol2_s5' => 'nullable',
            'ol2_g5' => 'nullable',
            'ol2_s6' => 'nullable',
            'ol2_g6' => 'nullable',
            'ol2_s7' => 'nullable',
            'ol2_g7' => 'nullable',
            'ol2_s8' => 'nullable',
            'ol2_g8' => 'nullable',
            'ol2_s9' => 'nullable',
            'ol2_g9' => 'nullable',
            'ol2_s10' => 'nullable',
            'ol2_g10' => 'nullable',
            'ol2_s11' => 'nullable',
            'ol2_g11' => 'nullable',
            'ol2_s12' => 'nullable',
            'ol2_g12' => 'nullable',
            'last_updated' => 'nullable|date',
        ];
    }
}
