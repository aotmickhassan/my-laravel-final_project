<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillDetail;
use App\Models\BillingSector;
use Illuminate\Support\Facades\Log;

class BillDetailController extends Controller
{

    public function fetchBillingSectors()
    {
        $billingSectors = BillingSector::all(); // Assuming BillingSector is the model
        return response()->json($billingSectors);
    }

    // Save data from the AJAX POST request
    public function saveData(Request $request)
    {
        try {
            $data = $request->input('tableData', []);

            if (empty($data)) {
                return response()->json(['message' => 'No data to save.'], 400);
            }

            foreach ($data as $row) {
                BillDetail::create([
                    'billing_sector_id' => $row['billing_sector'], // Billing sector ID
                    'bill_id' => $row['bill_id'], // Pass bill ID dynamically if applicable
                    'course_code' => $row['course_code'],
                    'count' => $row['count'],
                    'is_full_paper' => $row['paper_type'], // 1 for full, 0 for half
                    'rate' => $row['rate'],
                    'quantity' => $row['quantity'],
                ]);
            }

            return response()->json(['message' => 'Bill data saved successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Error saving bill details: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to save bill data.'], 500);
        }
    }


    public function index()
    {
        // Fetch all bill details from the database
        $billDetail = BillDetail::with('billingSector')->get(); // Including related billing sector if applicable

        // Return the index view with the bill details
        return view('billDetails.index', ['billDetails' => $billDetail]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return a form for creating a new bill detail
        return view('billDetails.create');
    }
}
// public function saveData(Request $request)
    // {
    //     $validated = $request->validate([
    //         'data.*.billing_sector_id' => 'required|exists:billing_sectors,id',
    //         'data.*.course_code' => 'required|string|max:255',
    //         'data.*.count' => 'required|integer|min:1',
    //         'data.*.is_full_paper' => 'required|boolean',
    //         'data.*.rate' => 'required|numeric|min:0',
    //         'data.*.total_amount' => 'required|numeric|min:0',
    //     ]);

    //     foreach ($validated['data'] as $item) {
    //         BillDetail::create([
    //             'billing_sector_id' => $item['billing_sector'],
    //             'course_code' => $item['course_no'],
    //             'count' => $item['scripts'],
    //             'is_full_paper' => $item['paper_type'],
    //             'rate' => $item['rate'],
    //         ]);
    //     }

    //     return response()->json(['message' => 'Data saved successfully'], 200);
    // }