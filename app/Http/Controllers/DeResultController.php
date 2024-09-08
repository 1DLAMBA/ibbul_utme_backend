<?php
namespace App\Http\Controllers;

use App\Http\Requests\DeResultRequest;
use App\Http\Resources\DeResultResource;
use App\Http\Resources\Utme_result_Resource;
use App\Imports\DeResultsImport;
use App\Models\DeResult;
use App\Models\utme_result;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DeResultController extends Controller
{
    public function index(Request $request)
    {
        // Get search query and pay_status from the request
        $searchQuery = $request->query('search');
        $payStatus = $request->header('pay_status');
        $page = $request->query('page', 1); // Default to page 1 if no page is provided
        $perPage = 10; // Number of items per page
    
        // Build the query to fetch records with `most_preferred_inst` not null
        $query = utme_result::whereNull('most_preferred_inst');
    
        // Apply search filter if search query is provided
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('cand_name', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('reg_number', 'LIKE', '%' . $searchQuery . '%');
            });
        }
    
        // Apply `pay_status` filter if provided
        if (!is_null($payStatus)) {
            $query->where('pay_status', $payStatus);
        }
    
        // Paginate the results
        $deResults = $query->paginate($perPage, ['*'], 'page', $page);
    
        // Transform results into a resource collection
        $utme_results = Utme_result_Resource::collection($deResults);
    
        // Return paginated results with pagination details
        return response()->json([
            'data' => $utme_results,
            'current_page' => $deResults->currentPage(),
            'per_page' => $deResults->perPage(),
            'total' => $deResults->total(),
        ], 200);
    }
    

    public function store(DeResultRequest $request)
    {
        $deResult = DeResult::create($request->validated());
        return new DeResultResource($deResult);
    }

    public function show($id)
    {
        $deResult = DeResult::findOrFail($id);
        return new DeResultResource($deResult);
    }

    public function update(DeResultRequest $request, $id)
    {
        $deResult = DeResult::findOrFail($id);
        $deResult->update($request->validated());
        return new DeResultResource($deResult);
    }

    public function destroy($id)
    {
        $deResult = DeResult::findOrFail($id);
        $deResult->delete();
        return response()->noContent();
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:xlsx,csv']);
        Excel::import(new DeResultsImport, $request->file('file'));
        return response()->json(['message' => 'Imported successfully']);
    }
}
