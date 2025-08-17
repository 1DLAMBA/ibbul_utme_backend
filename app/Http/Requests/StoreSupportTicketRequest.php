<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupportTicketRequest extends FormRequest
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
        $baseRules = [
            'topic' => 'required|string|in:Payment processing issues,Technical difficulties with the portal,Questions about eligibility requirements,Result submission problems,Account access issues,Other',
            'portalType' => 'required|string|in:utme,de,eligibility,login,general',
            
            // Accept student info at root level (new format)
            'student_name' => 'nullable|string|max:255',
            'reg_number' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            
            // Also accept student info nested (backward compatibility)
            'studentInfo' => 'nullable|array',
            'studentInfo.name' => 'nullable|string|max:255',
            'studentInfo.regNumber' => 'nullable|string|max:100',
            'studentInfo.phone' => 'nullable|string|max:20',
            'studentInfo.email' => 'nullable|email|max:255',
            
            // Accept original field names for backward compatibility
            'name' => 'nullable|string|max:255',
            'regNumber' => 'nullable|string|max:100',
        ];

        // Add topic-specific validation rules
        $topicRules = $this->getTopicSpecificRules();

        return array_merge($baseRules, $topicRules);
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $topic = $this->input('topic');
            
            if (!$topic) {
                return;
            }

            // Check if at least one required field is provided for the topic
            $this->validateTopicFields($validator, $topic);
        });
    }

    /**
     * Validate that at least one required field is provided for the topic.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @param string $topic
     * @return void
     */
    private function validateTopicFields($validator, $topic)
    {
        switch ($topic) {
            case 'Payment processing issues':
                $this->validatePaymentFields($validator);
                break;
            case 'Technical difficulties with the portal':
                $this->validateTechnicalFields($validator);
                break;
            case 'Questions about eligibility requirements':
                $this->validateEligibilityFields($validator);
                break;
            case 'Result submission problems':
                $this->validateResultFields($validator);
                break;
            case 'Account access issues':
                $this->validateAccessFields($validator);
                break;
            case 'Other':
                $this->validateOtherFields($validator);
                break;
        }
    }

    /**
     * Validate payment fields.
     */
    private function validatePaymentFields($validator)
    {
        $hasTransactionRef = $this->input('transactionRef') || $this->input('paymentDetails.transactionRef');
        $hasPaymentDate = $this->input('paymentDate') || $this->input('paymentDetails.paymentDate');
        $hasAmount = $this->input('amount') || $this->input('paymentDetails.amount');
        $hasDescription = $this->input('description') || $this->input('paymentDetails.description');

        if (!$hasTransactionRef || !$hasPaymentDate || !$hasAmount || !$hasDescription) {
            $validator->errors()->add('payment', 'All payment fields are required (transaction reference, payment date, amount, and description).');
        }
    }

    /**
     * Validate technical fields.
     */
    private function validateTechnicalFields($validator)
    {
        $hasBrowserDevice = $this->input('browserDevice') || $this->input('technicalDetails.browserDevice');
        $hasStepsToReproduce = $this->input('stepsToReproduce') || $this->input('technicalDetails.stepsToReproduce');

        if (!$hasBrowserDevice || !$hasStepsToReproduce) {
            $validator->errors()->add('technical', 'Browser/device information and steps to reproduce are required for technical issues.');
        }
    }

    /**
     * Validate eligibility fields.
     */
    private function validateEligibilityFields($validator)
    {
        $hasQuestion = $this->input('question') || $this->input('eligibilityDetails.question');
        $hasCurrentStatus = $this->input('currentStatus') || $this->input('eligibilityDetails.currentStatus');

        if (!$hasQuestion || !$hasCurrentStatus) {
            $validator->errors()->add('eligibility', 'Question and current status are required for eligibility questions.');
        }
    }

    /**
     * Validate result fields.
     */
    private function validateResultFields($validator)
    {
        $hasResultType = $this->input('resultType') || $this->input('resultDetails.resultType');
        $hasIssue = $this->input('issue') || $this->input('resultDetails.issue');

        if (!$hasResultType || !$hasIssue) {
            $validator->errors()->add('result', 'Result type and specific issue are required for result submission problems.');
        }
    }

    /**
     * Validate access fields.
     */
    private function validateAccessFields($validator)
    {
        $hasAccessProblem = $this->input('accessProblem') || $this->input('accessDetails.accessProblem');
        $hasAdditionalDetails = $this->input('additionalDetails') || $this->input('accessDetails.additionalDetails');

        if (!$hasAccessProblem || !$hasAdditionalDetails) {
            $validator->errors()->add('access', 'Access problem description and additional details are required for account access issues.');
        }
    }

    /**
     * Validate other fields.
     */
    private function validateOtherFields($validator)
    {
        $hasIssueCategory = $this->input('issueCategory') || $this->input('otherDetails.issueCategory');
        $hasDescription = $this->input('description') || $this->input('otherDetails.description');
        $hasStepsTaken = $this->input('stepsTaken') || $this->input('otherDetails.stepsTaken');

        if (!$hasIssueCategory || !$hasDescription || !$hasStepsTaken) {
            $validator->errors()->add('other', 'Issue category, description, and steps taken are required for other issues.');
        }
    }

    /**
     * Get topic-specific validation rules.
     *
     * @return array<string, mixed>
     */
    private function getTopicSpecificRules(): array
    {
        $topic = $this->input('topic');

        switch ($topic) {
            case 'Payment processing issues':
                return [
                    'transactionRef' => 'nullable|string|max:255',
                    'paymentDate' => 'nullable|date',
                    'amount' => 'nullable|string|max:100',
                    'description' => 'nullable|string|max:1000',
                    'paymentDetails.transactionRef' => 'nullable|string|max:255',
                    'paymentDetails.paymentDate' => 'nullable|date',
                    'paymentDetails.amount' => 'nullable|string|max:100',
                    'paymentDetails.description' => 'nullable|string|max:1000',
                ];

            case 'Technical difficulties with the portal':
                return [
                    'browserDevice' => 'nullable|string|max:255',
                    'errorMessage' => 'nullable|string|max:500',
                    'stepsToReproduce' => 'nullable|string|max:1000',
                    'technicalDetails.browserDevice' => 'nullable|string|max:255',
                    'technicalDetails.errorMessage' => 'nullable|string|max:500',
                    'technicalDetails.stepsToReproduce' => 'nullable|string|max:1000',
                ];

            case 'Questions about eligibility requirements':
                return [
                    'question' => 'nullable|string|max:1000',
                    'currentStatus' => 'nullable|string|max:255',
                    'eligibilityDetails.question' => 'nullable|string|max:1000',
                    'eligibilityDetails.currentStatus' => 'nullable|string|max:255',
                ];

            case 'Result submission problems':
                return [
                    'resultType' => 'nullable|string|max:100',
                    'issue' => 'nullable|string|max:1000',
                    'resultDetails.resultType' => 'nullable|string|max:100',
                    'resultDetails.issue' => 'nullable|string|max:1000',
                ];

            case 'Account access issues':
                return [
                    'accessProblem' => 'nullable|string|max:255',
                    'lastLogin' => 'nullable|date',
                    'additionalDetails' => 'nullable|string|max:1000',
                    'accessDetails.accessProblem' => 'nullable|string|max:255',
                    'accessDetails.lastLogin' => 'nullable|date',
                    'accessDetails.additionalDetails' => 'nullable|string|max:1000',
                ];

            case 'Other':
                return [
                    'issueCategory' => 'nullable|string|max:255',
                    'description' => 'nullable|string|max:1000',
                    'stepsTaken' => 'nullable|string|max:1000',
                    'otherDetails.issueCategory' => 'nullable|string|max:1000',
                    'otherDetails.description' => 'nullable|string|max:1000',
                    'otherDetails.stepsTaken' => 'nullable|string|max:1000',
                ];

            default:
                return [];
        }
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'topic.required' => 'Please select a support topic.',
            'topic.in' => 'Please select a valid support topic.',
            'portalType.required' => 'Portal type is required.',
            'portalType.in' => 'Please select a valid portal type.',
            
            // Payment processing issues
            'payment' => 'All payment fields are required (transaction reference, payment date, amount, and description).',
            
            // Technical difficulties
            'technical' => 'Browser/device information and steps to reproduce are required for technical issues.',
            
            // Eligibility questions
            'eligibility' => 'Question and current status are required for eligibility questions.',
            
            // Result submission
            'result' => 'Result type and specific issue description are required for result submission issues.',
            
            // Account access
            'access' => 'Access problem description and additional details are required for account access issues.',
            
            // Other issues
            'other' => 'Issue category, description, and steps already taken are required for other issues.',
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
            'topic' => 'support topic',
            'portalType' => 'portal type',
            'payment' => 'payment details',
            'technical' => 'technical details',
            'eligibility' => 'eligibility details',
            'result' => 'result details',
            'access' => 'access details',
            'other' => 'other details',
        ];
    }
}
