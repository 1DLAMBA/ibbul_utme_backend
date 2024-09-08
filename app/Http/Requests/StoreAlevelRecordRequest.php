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
            'candidate_name' => 'required|string|max:255',
            'year_of_issue' => 'required|digits:4',
            'course' => 'required|string|max:255',
            'class_of_graduation' => 'required|string|max:255',
            'subject1' => 'required|string|max:255',
            'subject1_grade' => 'required|string|max:2',
            'subject2' => 'required|string|max:255',
            'subject2_grade' => 'required|string|max:2',
            'subject3' => 'required|string|max:255',
            'subject3_grade' => 'required|string|max:2',
            'subject4' => 'required|string|max:255',
            'subject4_grade' => 'required|string|max:2',
        ];
    }
}
