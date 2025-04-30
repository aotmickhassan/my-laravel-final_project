<?php

namespace App\Http\Controllers;

use App\Models\BillDetail;
use Illuminate\Http\Request;
use App\Models\BillingSector;
use Illuminate\Support\Facades\DB;
use App\Models\BillingSessionGroup;
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
            // return response()->json(['data' => $data], 200);
            if (empty($data)) {
                return response()->json(['message' => 'No data to save.'], 400);
            }

            DB::transaction(function () use ($data) {
                $sessionGroup = BillingSessionGroup::create([
                    'details' => 'N/A',
                ]);

                $billDetails = [];

                foreach ($data as $row) {
                    $billDetails[] = [
                        'billing_sector_id' => $row['billing_sector'],
                        'bill_id' => $row['bill_id'],
                        'course_code' => $row['course_code'],
                        'count' => $row['count'],
                        'is_full_paper' => $row['paper_type'],
                        'rate' => $row['rate'],
                        'quantity' => $row['quantity'],
                        'billing_session_group' => $sessionGroup->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                $sessionGroup->billDetails()->createMany($billDetails);
            });

            // return response()->json(['data' => $data], 200);
            return response()->json(['message' => 'Bill data saved successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Error saving bill details: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to save bill data.'], 500);
        }
    }


    public function index(Request $request)
    {
        $id = $request->get('id'); // Get the ID from the request
        // Fetch all bill details from the database
        $billDetail = BillDetail::with('billingSector')->where('billing_session_group',$id)->get(); // Including related billing sector if applicable

        // Return the index view with the bill details
        return view('billDetails.index', ['billDetails' => $billDetail]);
    }
    public function bills()
    {
        // Fetch all bill details from the database
        $bills = BillingSessionGroup::with('billDetails')->get();
        return view('bills.index', ['bills' => $bills]);
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
