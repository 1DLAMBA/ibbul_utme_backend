<?php

namespace App\Services;

use App\Models\SupportTicket;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class SupportTicketService
{
    /**
     * Create a new support ticket.
     *
     * @param array $data
     * @return SupportTicket
     */
    public function create(array $data): SupportTicket
    {
        // Extract student info from the root level of the payload
        // The frontend sends both mapped fields (student_name, reg_number) and original fields (name, regNumber)
        $studentName = $data['student_name'] ?? $data['name'] ?? null;
        $studentRegNumber = $data['reg_number'] ?? $data['regNumber'] ?? null;
        $studentPhone = $data['phone'] ?? null;
        $studentEmail = $data['email'] ?? null;
        
        // Log the extracted data for debugging
        Log::info('SupportTicket create - Extracted student data:', [
            'student_name' => $studentName,
            'reg_number' => $studentRegNumber,
            'phone' => $studentPhone,
            'email' => $studentEmail,
            'raw_data' => $data
        ]);
        
        // Build the details array based on topic
        $details = $this->buildDetailsArray($data);
        
        // Create the ticket
        return SupportTicket::create([
            'topic' => $data['topic'],
            'portal_type' => $data['portalType'],
            'status' => 'pending',
            'student_name' => $studentName,
            'reg_number' => $studentRegNumber,
            'phone' => $studentPhone,
            'email' => $studentEmail,
            'details' => $details,
            'timestamp' => now(),
        ]);
    }

    /**
     * Update an existing support ticket.
     *
     * @param SupportTicket $ticket
     * @param array $data
     * @return SupportTicket
     */
    public function update(SupportTicket $ticket, array $data): SupportTicket
    {
        $ticket->update($data);
        return $ticket->fresh();
    }

    /**
     * Get all support tickets with optional filtering.
     *
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = SupportTicket::query();

        // Apply filters
        if (isset($filters['status'])) {
            $query->withStatus($filters['status']);
        }

        if (isset($filters['portal_type'])) {
            $query->forPortal($filters['portal_type']);
        }

        if (isset($filters['topic'])) {
            $query->where('topic', $filters['topic']);
        }

        if (isset($filters['reg_number'])) {
            $query->forStudent($filters['reg_number']);
        }

        if (isset($filters['priority'])) {
            $query->withPriority($filters['priority']);
        }

        if (isset($filters['assigned_to'])) {
            $query->assignedTo($filters['assigned_to']);
        }

        if (isset($filters['date_from'])) {
            $query->where('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to'])) {
            $query->where('created_at', '<=', $filters['date_to']);
        }

        // Sort by latest first
        $query->orderBy('created_at', 'desc');

        return $query->paginate($perPage);
    }

    /**
     * Get support tickets by status.
     *
     * @param string $status
     * @return Collection
     */
    public function getByStatus(string $status): Collection
    {
        return SupportTicket::withStatus($status)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get support tickets by portal type.
     *
     * @param string $portalType
     * @return Collection
     */
    public function getByPortal(string $portalType): Collection
    {
        return SupportTicket::forPortal($portalType)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get support tickets for a specific student.
     *
     * @param string $regNumber
     * @return Collection
     */
    public function getByStudent(string $regNumber): Collection
    {
        return SupportTicket::forStudent($regNumber)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get recent support tickets (last 7 days).
     *
     * @param int $limit
     * @return Collection
     */
    public function getRecent(int $limit = 10): Collection
    {
        return SupportTicket::where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get support ticket statistics.
     *
     * @return array
     */
    public function getStatistics(): array
    {
        $total = SupportTicket::count();
        $pending = SupportTicket::withStatus('pending')->count();
        $inProgress = SupportTicket::withStatus('in_progress')->count();
        $resolved = SupportTicket::withStatus('resolved')->count();
        $closed = SupportTicket::withStatus('closed')->count();

        // Get counts by portal type
        $byPortal = SupportTicket::selectRaw('portal_type, COUNT(*) as count')
            ->groupBy('portal_type')
            ->pluck('count', 'portal_type')
            ->toArray();

        // Get counts by topic
        $byTopic = SupportTicket::selectRaw('topic, COUNT(*) as count')
            ->groupBy('topic')
            ->pluck('count', 'topic')
            ->toArray();

        // Get average resolution time (for resolved tickets)
        $avgResolutionTime = SupportTicket::withStatus('resolved')
            ->whereNotNull('updated_at')
            ->get()
            ->avg(function ($ticket) {
                return $ticket->created_at->diffInHours($ticket->updated_at);
            });

        return [
            'total' => $total,
            'pending' => $pending,
            'in_progress' => $inProgress,
            'resolved' => $resolved,
            'closed' => $closed,
            'by_portal' => $byPortal,
            'by_topic' => $byTopic,
            'avg_resolution_time_hours' => round($avgResolutionTime ?? 0, 2),
        ];
    }

    /**
     * Build the details array based on the support topic.
     *
     * @param array $data
     * @return array
     */
    private function buildDetailsArray(array $data): array
    {
        $topic = $data['topic'];
        $details = [];

        // Log the topic and raw data for debugging
        Log::info('SupportTicket buildDetailsArray - Processing topic:', [
            'topic' => $topic,
            'raw_data' => $data
        ]);

        switch ($topic) {
            case 'Payment processing issues':
                $details = [
                    'transactionRef' => $data['transactionRef'] ?? $data['paymentDetails']['transactionRef'] ?? null,
                    'paymentDate' => $data['paymentDate'] ?? $data['paymentDetails']['paymentDate'] ?? null,
                    'amount' => $data['amount'] ?? $data['paymentDetails']['amount'] ?? null,
                    'description' => $data['description'] ?? $data['paymentDetails']['description'] ?? null,
                ];
                break;

            case 'Technical difficulties with the portal':
                $details = [
                    'browserDevice' => $data['browserDevice'] ?? $data['technicalDetails']['browserDevice'] ?? null,
                    'errorMessage' => $data['errorMessage'] ?? $data['technicalDetails']['errorMessage'] ?? null,
                    'stepsToReproduce' => $data['stepsToReproduce'] ?? $data['technicalDetails']['stepsToReproduce'] ?? null,
                ];
                break;

            case 'Questions about eligibility requirements':
                $details = [
                    'question' => $data['question'] ?? $data['eligibilityDetails']['question'] ?? null,
                    'currentStatus' => $data['currentStatus'] ?? $data['eligibilityDetails']['currentStatus'] ?? null,
                ];
                break;

            case 'Result submission problems':
                $details = [
                    'resultType' => $data['resultType'] ?? $data['resultDetails']['resultType'] ?? null,
                    'issue' => $data['issue'] ?? $data['resultDetails']['issue'] ?? null,
                ];
                break;

            case 'Account access issues':
                $details = [
                    'accessProblem' => $data['accessProblem'] ?? $data['accessDetails']['accessProblem'] ?? null,
                    'lastLogin' => $data['lastLogin'] ?? $data['accessDetails']['lastLogin'] ?? null,
                    'additionalDetails' => $data['additionalDetails'] ?? $data['accessDetails']['additionalDetails'] ?? null,
                ];
                break;

            case 'Other':
                $details = [
                    'issueCategory' => $data['issueCategory'] ?? $data['otherDetails']['issueCategory'] ?? null,
                    'description' => $data['description'] ?? $data['otherDetails']['description'] ?? null,
                    'stepsTaken' => $data['stepsTaken'] ?? $data['otherDetails']['stepsTaken'] ?? null,
                ];
                break;
        }

        // Log the extracted details for debugging
        Log::info('SupportTicket buildDetailsArray - Extracted details:', [
            'topic' => $topic,
            'details' => $details
        ]);

        return $details;
    }

    /**
     * Mark a ticket as resolved.
     *
     * @param SupportTicket $ticket
     * @param string $adminResponse
     * @param string|null $resolutionNotes
     * @return SupportTicket
     */
    public function markAsResolved(SupportTicket $ticket, string $adminResponse, ?string $resolutionNotes = null): SupportTicket
    {
        $ticket->update([
            'status' => 'resolved',
            'admin_response' => $adminResponse,
            'resolution_notes' => $resolutionNotes,
        ]);

        return $ticket->fresh();
    }

    /**
     * Assign a ticket to someone.
     *
     * @param SupportTicket $ticket
     * @param string $assignedTo
     * @return SupportTicket
     */
    public function assignTicket(SupportTicket $ticket, string $assignedTo): SupportTicket
    {
        $ticket->update([
            'assigned_to' => $assignedTo,
            'status' => 'in_progress',
        ]);

        return $ticket->fresh();
    }
}
