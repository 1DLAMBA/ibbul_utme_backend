<?php

namespace App\Http\Controllers;

use App\Models\AlevelRecord;
use App\Http\Requests\StoreAlevelRecordRequest;
use App\Http\Resources\AlevelRecordResource;
use App\Models\Institution;

class AlevelRecordController extends Controller
{
    /**
     * Display a listing of the records.
     */
    public function index()
    {
        $alevelRecords = AlevelRecord::all();
        return AlevelRecordResource::collection($alevelRecords);
    }

    /**
     * Store a new A-level record.
     */
    public function store(StoreAlevelRecordRequest $request, $reg_number)
    {
        $ol1_exists = AlevelRecord::where('reg_number', $request->reg_number)->first();
        if ($ol1_exists) {
        // $ol1_exists = AlevelRecord::where('reg_number', $request->reg_number)->first();
            $ol1_exists->delete();

            $validated_data = $request->validated();
            $validated_data['reg_number'] = $reg_number;
            if($validated_data['institution_name'] == 'others'){
                $validated_data['institution_name'] = $validated_data['other_institution_name'];
                $institution=Institution::create(['name'=>$validated_data['other_institution_name']]);
            }
            $record = AlevelRecord::create($validated_data);
            return response()->json('success', 200);
        } else {

            $validated_data = $request->validated();
            $validated_data['reg_number'] = $reg_number;
            if($validated_data['institution_name'] == 'others'){
                $validated_data['institution_name'] = $validated_data['other_institution_name'];
                $institution=Institution::create(['name'=>$validated_data['other_institution_name']]);
            }
            $record = AlevelRecord::create($validated_data);
            return new AlevelRecordResource($record);
        }
    }

    /**
     * Display a specific A-level record.
     */
    public function show(AlevelRecord $alevelRecord)
    {
        return new AlevelRecordResource($alevelRecord);
    }
}
