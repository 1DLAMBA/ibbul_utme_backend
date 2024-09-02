<?php
namespace App\Http\Controllers;

use App\Http\Requests\DeResultRequest;
use App\Http\Resources\DeResultResource;
use App\Imports\DeResultsImport;
use App\Models\DeResult;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DeResultController extends Controller
{
    public function index()
    {
        $deResults = DeResult::all();
        return DeResultResource::collection($deResults);
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
