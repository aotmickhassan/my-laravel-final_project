<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\BillDetail;
use Illuminate\Http\Request;
use App\Models\BillingSector;


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

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function fetchData()
    {
        $billingSectors = BillingSector::all();
        $courses = Course::all();
        $data = ['billingSectors' => $billingSectors, 'courses' => $courses];
        return response()->json($data);
    }
}
