<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportTicketResource extends JsonResource
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
            'topic' => $this->topic,
            'formatted_topic' => $this->formatted_topic,
            'portal_type' => $this->portal_type,
            'formatted_portal_type' => $this->formatted_portal_type,
            'status' => $this->status,
            'formatted_status' => $this->formatted_status,
            'student_name' => $this->student_name,
            'reg_number' => $this->reg_number,
            'phone' => $this->phone,
            'email' => $this->email,
            'details' => $this->details,
            'timestamp' => $this->timestamp?->toISOString(),
            'formatted_timestamp' => $this->timestamp?->format('F j, Y \a\t g:i A'),
            'created_at' => $this->created_at?->toISOString(),
            'formatted_created_at' => $this->created_at?->format('F j, Y \a\t g:i A'),
            'updated_at' => $this->updated_at?->toISOString(),
            'formatted_updated_at' => $this->updated_at?->format('F j, Y \a\t g:i A'),
            
            // Admin management fields
            'admin_response' => $this->when(isset($this->admin_response), $this->admin_response),
            'resolution_notes' => $this->when(isset($this->resolution_notes), $this->resolution_notes),
            'assigned_to' => $this->when(isset($this->assigned_to), $this->assigned_to),
            'priority' => $this->when(isset($this->priority), $this->priority),
            'formatted_priority' => $this->when(isset($this->priority), $this->formatted_priority),
            'estimated_resolution_time' => $this->when(isset($this->estimated_resolution_time), $this->estimated_resolution_time),
            
            // Computed fields
            'is_pending' => $this->status === 'pending',
            'is_in_progress' => $this->status === 'in_progress',
            'is_resolved' => $this->status === 'resolved',
            'is_closed' => $this->status === 'closed',
            'is_urgent' => $this->is_urgent,
            'is_assigned' => $this->is_assigned,
            'days_since_created' => $this->created_at ? $this->created_at->diffInDays(now()) : null,
            'hours_since_created' => $this->created_at ? $this->created_at->diffInHours(now()) : null,
        ];
    }
}
