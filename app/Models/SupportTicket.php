<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'topic',
        'portal_type',
        'status',
        'student_name',
        'reg_number',
        'phone',
        'email',
        'details',
        'timestamp',
        'admin_response',
        'resolution_notes',
        'assigned_to',
        'priority',
        'estimated_resolution_time',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'details' => 'array',
        'timestamp' => 'datetime',
    ];

    /**
     * Get the status options for the ticket.
     *
     * @return array<string>
     */
    public static function getStatusOptions(): array
    {
        return [
            'pending' => 'Pending',
            'in_progress' => 'In Progress',
            'resolved' => 'Resolved',
            'closed' => 'Closed',
        ];
    }

    /**
     * Get the portal type options.
     *
     * @return array<string>
     */
    public static function getPortalTypeOptions(): array
    {
        return [
            'utme' => 'UTME Portal',
            'de' => 'DE Portal',
            'eligibility' => 'Eligibility',
            'login' => 'Portal Access',
            'general' => 'General',
        ];
    }

    /**
     * Get the topic options.
     *
     * @return array<string>
     */
    public static function getTopicOptions(): array
    {
        return [
            'Payment processing issues' => 'Payment Processing Issues',
            'Technical difficulties with the portal' => 'Technical Difficulties',
            'Questions about eligibility requirements' => 'Eligibility Questions',
            'Result submission problems' => 'Result Submission Problems',
            'Account access issues' => 'Account Access Issues',
            'Other' => 'Other Issues',
        ];
    }

    /**
     * Get the priority options.
     *
     * @return array<string>
     */
    public static function getPriorityOptions(): array
    {
        return [
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High',
            'critical' => 'Critical',
        ];
    }

    /**
     * Scope a query to only include tickets with a specific status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include tickets for a specific portal.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $portalType
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForPortal($query, string $portalType)
    {
        return $query->where('portal_type', $portalType);
    }

    /**
     * Scope a query to only include tickets for a specific student.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $regNumber
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForStudent($query, string $regNumber)
    {
        return $query->where('reg_number', $regNumber);
    }

    /**
     * Scope a query to only include tickets with a specific priority.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $priority
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithPriority($query, string $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Scope a query to only include tickets assigned to a specific person.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $assignedTo
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAssignedTo($query, string $assignedTo)
    {
        return $query->where('assigned_to', $assignedTo);
    }

    /**
     * Get the formatted status.
     *
     * @return string
     */
    public function getFormattedStatusAttribute(): string
    {
        if (!$this->status) {
            return 'Unknown';
        }
        return self::getStatusOptions()[$this->status] ?? $this->status;
    }

    /**
     * Get the formatted portal type.
     *
     * @return string
     */
    public function getFormattedPortalTypeAttribute(): string
    {
        if (!$this->portal_type) {
            return 'Unknown';
        }
        return self::getPortalTypeOptions()[$this->portal_type] ?? $this->portal_type;
    }

    /**
     * Get the formatted topic.
     *
     * @return string
     */
    public function getFormattedTopicAttribute(): string
    {
        if (!$this->topic) {
            return 'Unknown';
        }
        return self::getTopicOptions()[$this->topic] ?? $this->topic;
    }

    /**
     * Get the formatted priority.
     *
     * @return string
     */
    public function getFormattedPriorityAttribute(): string
    {
        if (!$this->priority) {
            return 'Not Set';
        }
        return self::getPriorityOptions()[$this->priority] ?? $this->priority;
    }

    /**
     * Check if the ticket is urgent (high or critical priority).
     *
     * @return bool
     */
    public function getIsUrgentAttribute(): bool
    {
        if (!$this->priority) {
            return false;
        }
        return in_array($this->priority, ['high', 'critical']);
    }

    /**
     * Check if the ticket has been assigned.
     *
     * @return bool
     */
    public function getIsAssignedAttribute(): bool
    {
        return !empty($this->assigned_to);
    }
}
