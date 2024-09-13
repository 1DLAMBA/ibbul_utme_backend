<?php

namespace App\Http\Controllers;
use App\Imports\CoursesImport;
use App\Models\Course;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class CourseImportController extends Controller
{
    //
    public function import(Request $request)
    {
        Excel::import(new CoursesImport, $request->file('file'));

        return redirect()->back()->with('success', 'Courses imported successfully.');
    }

    public function index()
    {
        $de_courses =  Course::get();

        return response()->json(['data'=> $de_courses]);
    }
}
