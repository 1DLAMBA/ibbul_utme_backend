<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store_utme_result_Request;
use App\Http\Requests\Update_utme_result_Request;
use App\Http\Resources\Utme_result_Resource;
use App\Imports\UtmeResultImport;
use App\Models\utme_result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;

class UtmeResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function utme_login(Request $request)
     {
         // Validate the incoming request
         $request->validate([
             'reg_number' => 'required|string',
             'phone_no' => 'required|string',
         ]);
     
         $reg_number = $request->reg_number;
         $phone_no = $request->phone_no;
     
         // Query the database for the user with the provided registration number
         $login = utme_result::with('olevels')->where('reg_number', $reg_number)->first();
         Log::alert($request);
         // Check if the user exists
         if ($login) {
             // Check if the provided phone number matches the user's phone number
             if ($login->phone_no === $phone_no) {
                 return response()->json(['utme_result' => $login], 200);
             } else {
                 return response()->json(['error' => 'Invalid phone number or Registration Number'], 401);
             }
         } else {
             return response()->json(['error' => 'Invalid phone number or Registration Number'], 401);
         }
     }
     
    public function import(Request $request)
    {
        log::alert($request);


        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods',
        ]);

        Excel::import(new UtmeResultImport, $request->file('file'));

        return response()->json('success', 200);
    }
    public function index()
    {
        $utme_results = utme_result::all();
        return Utme_result_Resource::collection($utme_results);
    }

    public function utme_create(Request $request){
        $this->validate($request, [
            // your validation rules here
            'phone_no' => '',
            'reg_number' => '',
            // ...
        ]);
    
        $utme_result = utme_result::where('reg_number',$request->reg_number)->first();
        $utme_result->phone_no = $request->phone_no;
        $utme_result->pay_status = 1;
        $utme_result->save();
        return response()->json($utme_result, 201);
    }

    public function show(Request $id)
    {
        $utme_results =utme_result::with('olevels')->where('reg_number', $id->reg_number)->first();
        Log::alert($id);
        if($utme_results){

            return new Utme_result_Resource($utme_results);
        }else {
            return response()->json('Unauthorized', 401);
        }
    }

    public function store(Store_utme_result_Request $request)
    {
        $utme_result = utme_result::create($request->validated());
        // if($request->waec){};
        return response()->json($utme_result, 201);
    }

    public function update(Request $request, $reg_number)
    {
       $validated= $this->validate($request, [
            // your validation rules here
            'ol1_result_file' => '',
            'ol2_result_file' => '',
            'ol1_card_file' => '',
            'ol2_card_file' => '',
            'indigene_file' => '',
            'nin_file' => '',
            'school_cert_file' => '',
            // ...
        ]);
        $utme_result = utme_result::where('reg_number',$reg_number)->first();
        $utme_result->update($validated);
        return response()->json($utme_result, 200);
    }

    public function delete($id)
    {
        utme_result::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    // public function upload(Request $request, $id){
    //     $utme_result = utme_result::findOrFail($id);
    // }
}
