<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSupportTicketRequest extends FormRequest
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
            'status' => [
                'sometimes',
                'string',
                Rule::in(['pending', 'in_progress', 'resolved', 'closed']),
            ],
            'admin_response' => 'nullable|string|max:2000',
            'resolution_notes' => 'nullable|string|max:1000',
            'assigned_to' => 'nullable|string|max:255',
            'priority' => [
                'nullable',
                'string',
                Rule::in(['low', 'medium', 'high', 'critical']),
            ],
            'estimated_resolution_time' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'status.in' => 'Please select a valid status.',
            'admin_response.max' => 'Admin response cannot exceed 2000 characters.',
            'resolution_notes.max' => 'Resolution notes cannot exceed 1000 characters.',
            'assigned_to.max' => 'Assigned to field cannot exceed 255 characters.',
            'priority.in' => 'Please select a valid priority level.',
            'estimated_resolution_time.max' => 'Estimated resolution time cannot exceed 255 characters.',
        ];
    }

    /**
     * Get custom attributes for validation error messages.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'status' => 'ticket status',
            'admin_response' => 'admin response',
            'resolution_notes' => 'resolution notes',
            'assigned_to' => 'assigned to',
            'priority' => 'priority level',
            'estimated_resolution_time' => 'estimated resolution time',
        ];
    }
}
