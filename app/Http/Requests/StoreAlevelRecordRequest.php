<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlevelRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Set to true for now
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'institution_name' => 'required|string|max:255',
            'other_institution_name' => 'string|max:255',
            'candidate_name' => 'required|string|max:255',
            'year_of_issue' => 'required|digits:4',
            'course' => 'string|max:255',
            'Al1_file' => 'string|max:255',
            'result_type' => 'string|max:255',
            'class_of_graduation' => 'string|max:255',
            'subject1' => 'string|max:255',
            'subject1_grade' => 'string|max:2',
            'subject2' => 'string|max:255',
            'subject2_grade' => 'string|max:2',
            'subject3' => 'string|max:255',
            'subject3_grade' => 'string|max:2',
            'subject4' => 'string|max:255',
            'subject4_grade' => 'string|max:2',
            'mj0' => 'string|max:255',
            'mj0_grade' => 'string|max:255',
            'mj1' => 'string|max:255',
            'mj1_grade' => 'string|max:255',
            'mj2' => 'string|max:255',
            'mj2_grade' => 'string|max:255',
        ];
    }
}
