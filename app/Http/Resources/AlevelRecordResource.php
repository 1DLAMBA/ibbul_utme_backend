<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlevelRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'institution_name' => $this->institution_name,
            'candidate_name' => $this->candidate_name,
            'year_of_issue' => $this->year_of_issue,
            'course' => $this->course,
            'class_of_graduation' => $this->class_of_graduation,
            'subjects' => [
                ['name' => $this->subject1, 'grade' => $this->subject1_grade],
                ['name' => $this->subject2, 'grade' => $this->subject2_grade],
                ['name' => $this->subject3, 'grade' => $this->subject3_grade],
                ['name' => $this->subject4, 'grade' => $this->subject4_grade],
            ],
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
