<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all records from the exams table
        // $exams = Exam::all();
        $exams = Exam::select('exam_department', 'session_year')->get();
        // dd($exams);
        // Return the view and pass the fetched data
        return view('billDetails.index', ['exams' => $exams]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('billDetails.create');
    }
}
