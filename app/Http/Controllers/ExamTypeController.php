<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExamTypeResource;
use App\Models\ExamType;
use Illuminate\Http\Request;


class ExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ExamTypeResource::collection(ExamType::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new ExamTypeResource(ExamType::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamType $examType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamType $examType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamType $examType)
    {
        //
    }
}
