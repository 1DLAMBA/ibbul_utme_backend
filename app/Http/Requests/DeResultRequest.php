<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeResultRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'dept_sn' => 'required|string|max:255',
            'reg_number' => 'required|string|max:255|unique:de_results,reg_number,' . $this->route('de_result'),
            'cand_name' => 'required|string|max:255',
            'state_of_origin' => 'required|string|max:255',
            'lga' => 'required|string|max:255',
            'sex' => 'required|string|max:1',
            'age' => 'required|integer|min:1|max:150',
            'aggregate' => 'required|integer',
            'fac_abrev' => 'required|string|max:255',
            'cors_abrev' => 'required|string|max:255',
            'cors_id' => 'required|string|max:255',
            'phone_no' => 'required|string|max:255',
            'no_results' => 'required|string|max:255',
            'pay_status' => 'required|string|max:255',
            'gendate' => 'nullable|date',
        ];
    }
}
