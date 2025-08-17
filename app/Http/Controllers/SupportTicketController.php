<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupportTicketRequest;
use App\Http\Requests\UpdateSupportTicketRequest;
use App\Http\Resources\SupportTicketResource;
use App\Models\SupportTicket;
use App\Services\SupportTicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;

class SupportTicketController extends Controller
{
    public function __construct(
        private SupportTicketService $supportTicketService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $filters = $request->only([
            'status',
            'portal_type',
            'topic',
            'reg_number',
            'priority',
            'assigned_to',
            'date_from',
            'date_to'
        ]);

        $perPage = $request->get('per_page', 15);
        $tickets = $this->supportTicketService->getAll($filters, $perPage);

        return SupportTicketResource::collection($tickets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupportTicketRequest $request): JsonResponse
    {
        try {
            // Log the incoming request data for debugging
            Log::info('SupportTicket store - Incoming request data:', [
                'all_data' => $request->all(),
                'validated_data' => $request->validated()
            ]);
            
            $ticket = $this->supportTicketService->create($request->validated());
            
            // Log the created ticket for debugging
            Log::info('SupportTicket store - Created ticket:', [
                'ticket_id' => $ticket->id,
                'ticket_data' => $ticket->toArray()
            ]);
            
            return response()->json([
                'message' => 'Support ticket created successfully',
                'data' => new SupportTicketResource($ticket)
            ], 201);
        } catch (\Exception $e) {
            Log::error('SupportTicket store - Error creating ticket:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Failed to create support ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SupportTicket $supportTicket): JsonResponse
    {
        return response()->json([
            'data' => new SupportTicketResource($supportTicket)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupportTicketRequest $request, SupportTicket $supportTicket): JsonResponse
    {
        try {
            $ticket = $this->supportTicketService->update($supportTicket, $request->validated());
            
            return response()->json([
                'message' => 'Support ticket updated successfully',
                'data' => new SupportTicketResource($ticket)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update support ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupportTicket $supportTicket): JsonResponse
    {
        try {
            $supportTicket->delete();
            
            return response()->json([
                'message' => 'Support ticket deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete support ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get support tickets by status.
     */
    public function getByStatus(string $status): AnonymousResourceCollection
    {
        $tickets = $this->supportTicketService->getByStatus($status);
        return SupportTicketResource::collection($tickets);
    }

    /**
     * Get support tickets by portal type.
     */
    public function getByPortal(string $portalType): AnonymousResourceCollection
    {
        $tickets = $this->supportTicketService->getByPortal($portalType);
        return SupportTicketResource::collection($tickets);
    }

    /**
     * Get support tickets for a specific student.
     */
    public function getByStudent(string $regNumber): AnonymousResourceCollection
    {
        $tickets = $this->supportTicketService->getByStudent($regNumber);
        return SupportTicketResource::collection($tickets);
    }

    /**
     * Get recent support tickets.
     */
    public function getRecent(Request $request): AnonymousResourceCollection
    {
        $limit = $request->get('limit', 10);
        $tickets = $this->supportTicketService->getRecent($limit);
        return SupportTicketResource::collection($tickets);
    }

    /**
     * Get support ticket statistics.
     */
    public function getStatistics(): JsonResponse
    {
        $stats = $this->supportTicketService->getStatistics();
        
        return response()->json([
            'data' => $stats
        ]);
    }

    /**
     * Mark a ticket as resolved.
     */
    public function markAsResolved(Request $request, SupportTicket $supportTicket): JsonResponse
    {
        $request->validate([
            'admin_response' => 'required|string|max:2000',
            'resolution_notes' => 'nullable|string|max:1000',
        ]);

        try {
            $ticket = $this->supportTicketService->markAsResolved(
                $supportTicket,
                $request->admin_response,
                $request->resolution_notes
            );
            
            return response()->json([
                'message' => 'Support ticket marked as resolved',
                'data' => new SupportTicketResource($ticket)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to mark ticket as resolved',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Assign a ticket to someone.
     */
    public function assignTicket(Request $request, SupportTicket $supportTicket): JsonResponse
    {
        $request->validate([
            'assigned_to' => 'required|string|max:255',
        ]);

        try {
            $ticket = $this->supportTicketService->assignTicket(
                $supportTicket,
                $request->assigned_to
            );
            
            return response()->json([
                'message' => 'Support ticket assigned successfully',
                'data' => new SupportTicketResource($ticket)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to assign ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get support ticket options (statuses, portal types, topics).
     */
    public function getOptions(): JsonResponse
    {
        return response()->json([
            'data' => [
                'statuses' => SupportTicket::getStatusOptions(),
                'portal_types' => SupportTicket::getPortalTypeOptions(),
                'topics' => SupportTicket::getTopicOptions(),
                'priorities' => SupportTicket::getPriorityOptions(),
            ]
        ]);
    }

    /**
     * Bulk update ticket statuses.
     */
    public function bulkUpdateStatus(Request $request): JsonResponse
    {
        $request->validate([
            'ticket_ids' => 'required|array',
            'ticket_ids.*' => 'exists:support_tickets,id',
            'status' => 'required|string|in:pending,in_progress,resolved,closed',
        ]);

        try {
            $updatedCount = SupportTicket::whereIn('id', $request->ticket_ids)
                ->update(['status' => $request->status]);
            
            return response()->json([
                'message' => "Successfully updated {$updatedCount} tickets",
                'updated_count' => $updatedCount
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to bulk update tickets',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
