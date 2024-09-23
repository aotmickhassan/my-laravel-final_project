<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', ['teachers' => $teachers]);
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'mobile' => ['required', 'numeric', 'digits:11'],
            // 'mobile' => 'required|string|regex:/^[0-9]{10}$/',
            'email' => 'required|email|max:255',
        ]);

        $newTeacher = Teacher::create($data);

        return redirect()->route('teacher.index')
            ->with('success', 'Teacher created successfully');
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', ['teacher' => $teacher]);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'mobile' => ['required', 'numeric', 'digits:11'],
            // 'mobile' => 'required|string|regex:/^[0-9]{10}$/',
            'email' => 'required|email|max:255',
        ]);

        $teacher->update($data);

        return redirect()->route('teacher.index')
            ->with('success', 'Teacher updated successfully');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('teacher.index')
            ->with('success', 'Teacher deleted successfully');
    }
}
