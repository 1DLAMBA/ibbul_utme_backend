<?php

namespace App\Http\Controllers;

use App\Imports\InstitutionImport;
use App\Models\Institution;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class InstitutionImportController extends Controller
{
    //
    public function import(Request $request)
    {
        Excel::import(new InstitutionImport, $request->file('file'));

        return redirect()->back()->with('success', 'Courses imported successfully.');
    }

    public function index()
    {
        $instituions =  Institution::get();

        return response()->json(['data'=> $instituions]);
    }
}
