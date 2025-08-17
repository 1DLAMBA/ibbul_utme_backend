<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExamGradeResource;
use App\Models\ExamGrade;
use Illuminate\Http\Request;


class ExamGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  ExamGradeResource::collection(ExamGrade::all());
        // $collection =  ExamGradeResource::collection(ExamGrade::all());
        // $plucked = $collection->pluck('nabteb');
        // return  $plucked->all();
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
        return new ExamGradeResource(ExamGrade::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamGrade $examGrade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamGrade $examGrade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamGrade $examGrade)
    {
        //
    }
}
