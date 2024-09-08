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
    public function index()
    {
        $deResults = utme_result::whereNull('most_preferred_inst')->get();
    
    // Return the filtered collection of results
    return Utme_result_Resource::collection($deResults);
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
