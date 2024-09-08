<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store_utme_result_Request;
use App\Http\Requests\Update_utme_result_Request;
use App\Http\Resources\DeResultResource;
use App\Http\Resources\Utme_result_Resource;
use App\Imports\UtmeResultImport;
use App\Models\DeResult;
use App\Models\Olevel;
use App\Models\utme_result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $utme_results = utme_result::with('olevels')->where('reg_number', $reg_number)->first();
        $de_results = DeResult::with('olevels')->where('reg_number', $reg_number)->first();
        // Log::alert($id);
        // $login = utme_result::with('olevels')->where('reg_number', $reg_number)->first();

        if ($utme_results) {

            if ($utme_results->phone_no === $phone_no) {
                return response()->json(['utme_result' => $utme_results], 200);
            } else {
                return response()->json(['error' => 'Invalid phone number or Registration Number'], 401);
            }
        } else {
            if ($de_results) {
                if ($de_results->phone_no === $phone_no) {
                    return response()->json(['utme_result' => $de_results], 200);
                } else {
                    return response()->json(['error' => 'Invalid phone number or Registration Number'], 401);
                }
            } else {

                return response()->json('Unauthorized', 401);
            }
        }


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
    public function view_utme_list(Request $request)
    {
        // Get search query and pay_status from the request
        $searchQuery = $request->query('search');
        $payStatus = $request->header('pay_status');
        $page = $request->query('page', 1); // Default to page 1 if no page is provided
        $perPage = 10; // Number of items per page
    
        // Build the query to fetch records with `most_preferred_inst` not null
        $query = utme_result::whereNotNull('most_preferred_inst');
    
        // Apply search filter if search query is provided
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('cand_name', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('reg_number', 'LIKE', '%' . $searchQuery . '%');
            });
        }
    
        // Apply `pay_status` filter if provided
        if (!is_null($payStatus)) {
            $query->where('pay_status', $payStatus);
        }
    
        // Paginate the results
        $deResults = $query->paginate($perPage, ['*'], 'page', $page);
    
        // Transform results into a resource collection
        $utme_results = Utme_result_Resource::collection($deResults);
    
        // Return paginated results with pagination details
        return response()->json([
            'data' => $utme_results,
            'current_page' => $deResults->currentPage(),
            'per_page' => $deResults->perPage(),
            'total' => $deResults->total(),
        ], 200);
    }
    

    public function index(Request $request)
    {
        // Get search query and pay_status from the request
        $searchQuery = $request->query('search');
        $payStatus = $request->header('pay_status');
        $page = $request->query('page', 1); // Default to page 1 if no page is provided
        $perPage = 10; // Number of items per page
    
        // Build the query to fetch all records and apply search and pay_status filters
        $query = utme_result::query();
    
        // Apply search filter
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('cand_name', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('reg_number', 'LIKE', '%' . $searchQuery . '%');
            });
        }
    
        // Apply `pay_status` filter if provided
        if (!is_null($payStatus)) {
            $query->where('pay_status', $payStatus);
        }
    
        // Paginate the results
        $deResults = $query->paginate($perPage, ['*'], 'page', $page);
    
        // Transform results into a resource collection
        $utme_results = Utme_result_Resource::collection($deResults);
    
        // Return paginated results with pagination details
        return response()->json([
            'data' => $utme_results,
            'current_page' => $deResults->currentPage(),
            'per_page' => $deResults->perPage(),
            'total' => $deResults->total(),
        ], 200);
    }
    
    // -----------------------CREATING NEW UTME RECORD( NEW REGISTERED================)
    public function utme_create(Request $request)
    {
        $this->validate($request, [
            // your validation rules here
            'phone_no' => '',
            'reg_number' => '',
            // ...
        ]);

        $utme_results = utme_result::with('olevels')->where('reg_number', $request->reg_number)->first();
        $de_results = DeResult::with('olevels')->where('reg_number', $request->reg_number)->first();
        // Log::alert($id);
        if ($utme_results) {

            $utme_result = utme_result::where('reg_number', $request->reg_number)->first();
            $utme_result->phone_no = $request->phone_no;
            $utme_result->pay_status = 1;
            $utme_result->save();
            return response()->json($utme_result, 201);
        } else {
            if ($de_results) {
                $de_results = DeResult::where('reg_number', $request->reg_number)->first();
                $de_results->phone_no = $request->phone_no;
                $de_results->pay_status = 1;
                $de_results->save();
                return response()->json($de_results, 201);
            } else {

                return response()->json('Unauthorized', 401);
            }
        }
    }

    public function create_new_utme(Request $request)
    {

        try {
            // Temporarily bypass validation for debugging
            $create = utme_result::create($request->all());
            $create->pay_status = 0;
            $create->save();
            return response()->json(['success' => 'Success'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 401);
        }
    }


    public function show(Request $id)
    {
        $utme_results = utme_result::with('olevels')->where('reg_number', $id->reg_number)->first();
        $de_results = DeResult::with('olevels')->where('reg_number', $id->reg_number)->first();
        Log::alert($id);
        if ($utme_results) {

            return new Utme_result_Resource($utme_results);
        } else {
            if ($de_results) {
                return new DeResultResource($de_results);
            } else {

                return response()->json('Unauthorized', 401);
            }
        }
    }
    public function get($reg_number)
    {
        $utme_results = utme_result::with('olevels')->where('reg_number', $reg_number)->first();
        $de_results = DeResult::with('olevels')->where('reg_number', $reg_number)->first();
        Log::alert($reg_number);
        if ($utme_results) {

            return response()->json(['data' => $utme_results], 200);
        } else {
            if ($de_results) {
                return response()->json(['data' => $de_results], 200);
            }
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
        $validated = $this->validate($request, [
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
        $utme_result = utme_result::where('reg_number', $reg_number)->first();
        $utme_result->update($validated);
        return response()->json($utme_result, 200);
    }

    public function update_utme(Request $request, $reg_number)
    {
        // Define the validation rules based on the payload structure
        $rules = [
            'age' => 'required|integer|min:1|max:100',
            'cand_name' => 'required|string|max:255',
            'cors_abrev' => 'required|string|max:255',
            'eng_score' => 'required|integer|min:0|max:100',
            'fac_abrev' => 'required|string|max:255',
            'lga' => 'required|string|max:255',
            'most_preferred_inst' => 'required|string|max:255',
            'phone_no' => 'required|string|max:15',
            'reg_number' => 'required|string|max:255',
            'sex' => 'required|string|in:M,F',
            'state_of_origin' => 'nullable|string|max:255',
            'subj2' => 'required|string|max:255',
            'subj2_score' => 'required|integer|min:0|max:100',
            'subj3' => 'required|string|max:255',
            'subj3_score' => 'required|integer|min:0|max:100',
            'subj4' => 'required|string|max:255',
            'subj4_score' => 'required|integer|min:0|max:100',
            'total_score' => 'required|integer|min:0|max:400',
        ];

        // Validate the request data
        $validated = $request->validate($rules);

        // Check if a UTME result with the given reg_number exists
        $check_reg = utme_result::where('reg_number', $request->reg_number)->first();

        if ($check_reg) {
            if ($request->reg_number == $reg_number) {
                // Begin a database transaction
                DB::beginTransaction();

                try {
                    // Update the reg_number in the olevels table first
                    Olevel::where('reg_number', $reg_number)->update(['reg_number' => $request->reg_number]);

                    // Then update the record in the utme_results table
                    $utme_result = utme_result::where('reg_number', $reg_number)->first();
                    $utme_result->update($validated);

                    // Commit the transaction
                    DB::commit();

                    return response()->json($utme_result, 200);
                } catch (\Exception $e) {
                    // If something goes wrong, rollback the transaction
                    DB::rollBack();

                    return response()->json(['error' => $e->getMessage()], 500);
                }
            } else {
                // If the reg_number in the request doesn't match the one being updated
                return response()->json('A student with that registration number already exists.', 401);
            }
        } else {
            Log::alert('father');
            // Begin a database transaction
            Olevel::where('reg_number', $reg_number)->update(['reg_number' => $request->reg_number]);

            // Then update the record in the utme_results table
            $utme_result = utme_result::where('reg_number', $reg_number)->first();
            $utme_result->update($validated);


            // Return the updated record as a JSON response
            return response()->json($utme_result, 200);
        }
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
