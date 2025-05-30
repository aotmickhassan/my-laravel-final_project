<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\BillingSector;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        $billingSectors = BillingSector::all(); // Fetch billing sector data
        // $billingSectorFetchUrl = route('billingSectorFetch.data');

        // Pass data to the view
        return view('departments.index', compact('departments', 'billingSectors'), ['departments' => $departments]);
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
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }

    public function getDeptInfo()
    {
        $departments = Department::select('id', 'name')->get();
        return response()->json($departments);
    }

}
