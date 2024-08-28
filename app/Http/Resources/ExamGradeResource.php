<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamGradeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'waec' => $this->waec,
            'neco' => $this->neco,
            'nabteb' => $this->nabteb,
            'grade2' => $this->grade2,
            'nbais' => $this->nbais,
        ];
    }
}
