<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store_olevel_Request;
use App\Http\Requests\Update_olevel_Request;
use App\Http\Resources\OlevelResource;
use App\Imports\OlevelImport;
use App\Models\Olevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class OlevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $oleve_utmes = Olevel::all();
        return OlevelResource::collection($oleve_utmes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Store_olevel_Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $oleve_utme = Olevel::create($request->validated());
        return response()->json($oleve_utme, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $oleve_utme = Olevel::findOrFail($id);
        return new OlevelResource($oleve_utme);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Olevel $olevel)
    {
        //
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods',
        ]);

        Excel::import(new OlevelImport, $request->file('file'));

        return response()->json('success', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_ol1(Update_olevel_Request $request, $reg_number)
    {
        //
        Log::alert($request);
        $ol1_exists = Olevel::where('reg_number', $request->reg_number)->first();
        $ol1_find = Olevel::where('olevel1_examno', $request->olevel1_examno)->first();
        $ol2_find = Olevel::where('olevel2_examno', $request->olevel1_examno)->first();
        if ($ol1_exists) {

            if ($request->olevel1_examilyear_t) {

                if ($ol1_find) {

                    $found_ol1_reg = $ol1_find->reg_number;
                    $found_ol1_year = $ol1_find->olevel1_examilyear_t;
                    $found_ol2_year = $ol1_find->olevel2_examilyear_t;
                    $request_ol1_examYr = $request->olevel1_examilyear_t;
                    $check_years = $found_ol1_year == $request_ol1_examYr;
                    // Check if exam number exists for a different user
                    if ($reg_number == $ol1_find->reg_number) {
                        if ($request->olevel1_examilyear_t == $ol1_find->olevel2_examilyear_t) {
                            if ($request->olevel1_exam == $ol1_find->olevel2_exam) {
                                if ($request->olevel1_examno == $ol1_find->olevel2_examno) {

                                    return response()->json('Different Candidate Examination year exists with same examination number and exam type', 400);
                                } else {
                                    $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                                    $validated_data = $request->validated();
                                    $oleve_utme->update($validated_data);
                                    return response()->json('success', 200);
                                }
                            } else {
                                $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                                $validated_data = $request->validated();
                                $oleve_utme->update($validated_data);
                                return response()->json('success', 200);
                            }
                        } else {
                            $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                            $validated_data = $request->validated();
                            $oleve_utme->update($validated_data);
                            return response()->json('success', 200);
                        }
                    } else {
                        if ($request->olevel1_examilyear_t == $ol1_find->olevel1_examilyear_t || $ol1_find->olevel2_examilyear_t) {
                            if ($request->olevel1_exam == $ol1_find->olevel2_exam || $ol1_find->olevel1_exam) {
                                return response()->json('Candidate Examination year exists with same examination number and exam type', 400);
                            } else {
                                $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                                $validated_data = $request->validated();
                                $oleve_utme->update($validated_data);
                                return response()->json('success', 200);
                            }
                        } else {
                            $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                            $validated_data = $request->validated();
                            $oleve_utme->update($validated_data);
                            return response()->json('success', 200);
                        }
                    }
                } else {
                    if ($ol2_find) {
                        if ($ol2_find->olevel1_exam == $request->olevel1_exam) {
                            if ($ol2_find->olevel2_examilyear_t == $request->olevel1_examilyear_t) {

                                return response()->json('Different olevel Examination year exists with same examination number and exam type', 400);
                            } else {
                                $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                                $validated_data = $request->validated();
                                $oleve_utme->update($validated_data);
                                return response()->json('success', 200);
                            }
                        } else {
                            $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                            $validated_data = $request->validated();
                            $oleve_utme->update($validated_data);
                            return response()->json('success', 200);
                        }
                    } else {

                        $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                        $validated_data = $request->validated();
                        $oleve_utme->update($validated_data);
                        return response()->json('success', 200);
                    }
                };
            } else {
                return response()->json('Exam year required', 400);
            }
        } else {
            // $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
            $validated_data = $request->validated();
            foreach ($validated_data as $key => $value) {
                if (is_array($value) || is_object($value)) {
                    $validated_data[$key] = null; // Set to null if it's an array or object
                }
            }
            $validated_data['reg_number'] = $reg_number;
            
            $oleve_utme = Olevel::create($validated_data);
            return response()->json('success', 200);
        }
    }
    public function update_ol2(Update_olevel_Request $request, $reg_number)
    {
        //
        Log::alert($reg_number);
        $ol1_exists = Olevel::where('reg_number', $request->reg_number)->first();
        $ol2_find = Olevel::where('olevel2_examno', $request->olevel2_examno)->first();
        $ol1_find = Olevel::where('olevel1_examno', $request->olevel2_examno)->first();
        if ($ol1_exists) {

            if ($request->olevel2_examilyear_t) {

                if ($ol1_find) {

                    $found_ol1_reg = $ol1_find->reg_number;
                    $found_ol1_year = $ol1_find->olevel1_examilyear_t;
                    $found_ol2_year = $ol1_find->olevel2_examilyear_t;
                    $request_ol1_examYr = $request->olevel1_examilyear_t;
                    $check_years = $found_ol1_year == $request_ol1_examYr;
                    // Check if exam number exists for a different user
                    if ($reg_number == $ol1_find->reg_number) {
                        if ($request->olevel2_examilyear_t == $ol1_find->olevel1_examilyear_t) {
                            if ($request->olevel2_exam == $ol1_find->olevel1_exam) {
                                if ($request->olevel2_examno == $ol1_find->olevel1_examno) {

                                    return response()->json('Different Candidate Examination year exists with same examination number and exam type', 400);
                                } else {
                                    $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                                    $validated_data = $request->validated();
                                    $oleve_utme->update($validated_data);
                                    return response()->json('success', 200);
                                }
                            } else {
                                $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                                $validated_data = $request->validated();
                                $oleve_utme->update($validated_data);
                                return response()->json('success', 200);
                            }
                        } else {
                            $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                            $validated_data = $request->validated();
                            $oleve_utme->update($validated_data);
                            return response()->json('success', 200);
                        }
                    } else {
                        if ($request->olevel2_examilyear_t == $ol1_find->olevel2_examilyear_t || $ol1_find->olevel1_examilyear_t) {
                            if ($request->olevel2_exam == $ol1_find->olevel1_exam || $ol1_find->olevel2_exam) {
                                return response()->json('Candidate Examination year exists with same examination number and exam type', 400);
                            } else {
                                $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                                $validated_data = $request->validated();
                                $oleve_utme->update($validated_data);
                                return response()->json('success', 200);
                            }
                        } else {
                            $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                            $validated_data = $request->validated();
                            $oleve_utme->update($validated_data);
                            return response()->json('success', 200);
                        }
                    }
                } else {
                    if ($ol2_find) {
                        if ($ol2_find->olevel1_exam == $request->olevel1_exam) {
                            if ($ol2_find->olevel2_examilyear_t == $request->olevel1_examilyear_t) {

                                return response()->json('Different olevel Examination year exists with same examination number and exam type', 400);
                            } else {
                                $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                                $validated_data = $request->validated();
                                $oleve_utme->update($validated_data);
                                return response()->json('success', 200);
                            }
                        } else {
                            $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                            $validated_data = $request->validated();
                            $oleve_utme->update($validated_data);
                            return response()->json('success', 200);
                        }
                    } else {

                        $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
                        $validated_data = $request->validated();
                        $oleve_utme->update($validated_data);
                        return response()->json('success', 200);
                    }
                };
            } else {
                return response()->json('Exam year required', 400);
            }
        } else {
            // $oleve_utme = Olevel::where('reg_number', $reg_number)->first();
            $validated_data = $request->validated();
            foreach ($validated_data as $key => $value) {
                if (is_array($value) || is_object($value)) {
                    $validated_data[$key] = null; // Set to null if it's an array or object
                }
            }
            $validated_data['reg_number'] = $reg_number;
            
            $oleve_utme = Olevel::create($validated_data);
            return response()->json('success', 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Olevel::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
