<?php

namespace App\Http\Controllers;

use App\Models\BillingSector;
use App\Models\BillDetail;
use Illuminate\Http\Request;


class BillingSectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function fetchData()
    {
        $data = BillingSector::all();
        return response()->json($data);
    }
    // public function saveData(Request $request)
    // {
    //     $tableData = $request->input('tableData');

    //     if (is_array($tableData) && count($tableData) > 0) {
    //         foreach ($tableData as $row) {
    //             \DB::table('bill_details')->insert([
    //                 'billing_sector_id' => $row['billing_sector'],
    //                 'bill_id' => $row['bill_id'], // You need to pass `bill_id` from the request or set it dynamically
    //                 'course_code' => $row['course_no'],
    //                 'count' => $row['scripts'],
    //                 'is_full_paper' => $row['paper_type'], // Assuming 1 = Full Paper, 0 = Half Paper
    //                 'rate' => $row['rate'],
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ]);
    //         }

    //         return response()->json(['message' => 'Data saved successfully!']);
    //     }

    //     return response()->json(['message' => 'No data to save.'], 400);
    // }
}


//     public function saveData(Request $request)
// {
//     // Check incoming request data
//     dd($request->all());


    // public function saveData(Request $request)
    // {
    //     // Validate the incoming request data
    //     $validator = Validator::make($request->all(), [
    //         'data' => 'required|array',
    //         'data.*.billing_sector' => 'required|exists:billing_sectors,id',
    //         'data.*.course_no' => 'required|string|max:255',
    //         'data.*.scripts' => 'required|integer|min:1',
    //         'data.*.paper_type' => 'required|boolean',
    //         'data.*.rate' => 'required|numeric|min:0',
    //         'data.*.total_amount' => 'required|numeric|min:0',
    //     ]);

    //     // Check for validation failures
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validation failed',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

        

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data saved successfully!',
    //     ], 200);
    // }
