<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Store_olevel_Request extends FormRequest
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
            //
            'uid' => 'nullable|string',
            'reg_number' => 'nullable|string',
            'olevel1_exam' => 'nullable|string',
            'olevel1_examno' => 'nullable|string',
            'olevel1_examilyear' => 'nullable|integer',
            'olevel1_examilyear_t' => 'nullable|string',
            'olevel1_exammonth' => 'nullable|string',
            'olevel1_exammonth_t' => 'nullable|string',
            'ol1_result_pin' => 'nullable|string',
            'ol1_result_sno' => 'nullable|string',
            'ol1_s1' => 'nullable|string',
            'ol1_g1' => 'nullable|string',
            'ol1_s2' => 'nullable|string',
            'ol1_g2' => 'nullable|string',
            'ol1_s3' => 'nullable|string',
            'ol1_g3' => 'nullable|string',
            'ol1_s4' => 'nullable|string',
            'ol1_g4' => 'nullable|string',
            'ol1_s5' => 'nullable|string',
            'ol1_g5' => 'nullable|string',
            'ol1_s6' => 'nullable|string',
            'ol1_g6' => 'nullable|string',
            'ol1_s7' => 'nullable|string',
            'ol1_g7' => 'nullable|string',
            'ol1_s8' => 'nullable|string',
            'ol1_g8' => 'nullable|string',
            'ol1_s9' => 'nullable|string',
            'ol1_g9' => 'nullable|string',
            'ol1_s10' => 'nullable|string',
            'ol1_g10' => 'nullable|string',
            'ol1_s11' => 'nullable|string',
            'ol1_g11' => 'nullable|string',
            'ol1_s12' => 'nullable|string',
            'ol1_g12' => 'nullable|string',
            'olevel2_exam' => 'nullable|string',
            'olevel2_examno' => 'nullable|string',
            'olevel2_examyear' => 'nullable|integer',
            'olevel2_examyear_t' => 'nullable|string',
            'olevel2_exammonth' => 'nullable|string',
            'olevel2_exammonth_t' => 'nullable|string',
            'ol2_result_pin' => 'nullable|string',
            'ol2_result_sno' => 'nullable|string',
            'ol2_s1' => 'nullable|string',
            'ol2_g1' => 'nullable|string',
            'ol2_s2' => 'nullable|string',
            'ol2_g2' => 'nullable|string',
            'ol2_s3' => 'nullable|string',
            'ol2_g3' => 'nullable|string',
            'ol2_s4' => 'nullable|string',
            'ol2_g4' => 'nullable|string',
            'ol2_s5' => 'nullable|string',
            'ol2_g5' => 'nullable|string',
            'ol2_s6' => 'nullable|string',
            'ol2_g6' => 'nullable|string',
            'ol2_s7' => 'nullable|string',
            'ol2_g7' => 'nullable|string',
            'ol2_s8' => 'nullable|string',
            'ol2_g8' => 'nullable|string',
            'ol2_s9' => 'nullable|string',
            'ol2_g9' => 'nullable|string',
            'ol2_s10' => 'nullable|string',
            'ol2_g10' => 'nullable|string',
            'ol2_s11' => 'nullable|string',
            'ol2_g11' => 'nullable|string',
            'ol2_s12' => 'nullable|string',
            'ol2_g12' => 'nullable|string',
            'last_updated' => 'nullable|date',
        ];
    }
}
