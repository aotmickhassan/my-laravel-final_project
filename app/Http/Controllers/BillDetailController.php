<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Http\Request;
use App\Models\BillingSector;
use Illuminate\Support\Facades\DB;
use App\Models\BillingSessionGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BillDetailController extends Controller
{

    public function fetchBillingSectors()
    {
        $billingSectors = BillingSector::with('course')->all(); // Assuming BillingSector is the model
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
    
            DB::transaction(function () use ($data, $request) {
                $sessionGroup = BillingSessionGroup::create([
                'details'          => 'N/A',
                'created_by'       => Auth::id(),
                'dept'             => Auth::user()->dept,
                'session'          => $request->input('session'),
                'exam_dept'        => $request->input('exam_dept'),
                'year'             => $request->input('year'),
                'semester'         => $request->input('semester'),
                'exam_start_date'  => $request->input('exam_start_date'),
                'exam_end_date'    => $request->input('exam_end_date'),
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
    
            return response()->json(['message' => 'Bill data saved successfully.'], 200);
    
        } catch (\Exception $e) {
            Log::error('Error saving bill details: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    


    public function index(Request $request)
    {
        $id = $request->get('id');
    
        $billSessionGroup = BillingSessionGroup::with(['department','creator'])->findOrFail($id);
    
        if (Auth::id() !== $billSessionGroup->created_by && Auth::user()->role !== 'admin') {
            abort(403, 'Access Denied: You are not the owner of this bill.');
        }
    
        $billDetail = BillDetail::with('billingSector')
            ->where('billing_session_group', $id)
            ->get();
    
        $dept_name = $billSessionGroup->department->name;
        $session = $billSessionGroup->session;
        return view('billDetails.index', [
            'billDetails' => $billDetail,
            'dept' => $dept_name,
            'session' => $session,
            'creator'     => $billSessionGroup->creator->name,
            'address'     => $billSessionGroup->creator->address,
            'exam_dept' => $billSessionGroup->exam_dept,
            'year' => $billSessionGroup->year,
            'semester' => $billSessionGroup->semester,
            'exam_start_date' => $billSessionGroup->exam_start_date,
            'exam_end_date' => $billSessionGroup->exam_end_date,
        ]);
    }
    
    public function bills()
    {
        $query = BillingSessionGroup::with(['billDetails', 'creator']);
    
        if (Auth::user()->role !== 'admin') {
            $query->where('created_by', Auth::id());
        }
    
        $bills = $query->get();
    
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
