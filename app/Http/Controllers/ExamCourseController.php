<?php
namespace App\Http\Controllers;

use App\Http\Resources\ExamCourseResource;
use App\Models\ExamCourse;
use Illuminate\Http\Request;

class ExamCourseController extends Controller
{
    public function index()
    {
        $examCourses = ExamCourse::all();
        return ExamCourseResource::collection($examCourses);
    }

    public function store(Request $request)
    {
        $examCourse = ExamCourse::create($request->all());
        return new ExamCourseResource($examCourse);
    }

    public function show(ExamCourse $examCourse)
    {
        return new ExamCourseResource($examCourse);
    }

    public function update(Request $request, ExamCourse $examCourse)
    {
        $examCourse->update($request->all());
        return new ExamCourseResource($examCourse);
    }

    public function destroy(ExamCourse $examCourse)
    {
        $examCourse->delete();
        return response()->noContent();
    }
}