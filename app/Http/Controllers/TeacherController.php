<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
{
    $teachers = User::where('role', 'teacher')->get(); // Filter users by role
    return view('teachers.index', ['teachers' => $teachers]);
}


public function create()
{
    $departments = Department::select('id', 'name')->get();
    return view('teachers.create', compact('departments'));
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'department' => 'required|integer|exists:departments,id',
            'mobile' => 'required|string|max:11',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
    
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'dept' => $validated['department'],
            'phone' => $validated['mobile'],
            'designation' => $validated['designation'], // if added in User model/table
            'role' => 'teacher', // ✅ hardcoded role
        ]);
    
        return redirect()->route('teacher.index')->with('success', 'Teacher created successfully.');
    }
    

    public function edit(User $teacher)
    {
        $departments = Department::select('id', 'name')->get();
        return view('teachers.edit', compact('teacher', 'departments'));
    }
    
    

    public function update(Request $request, User $teacher)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'mobile' => ['required', 'numeric', 'digits:11'],
            'department' => 'required|integer|exists:departments,id', // 👈 expects the ID
            'email' => 'required|email|max:255',
        ]);
    
        $teacher->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'dept' => $data['department'], // ✅ just save the department ID
            'phone' => $data['mobile'],
            'designation' => $data['designation'], // if this column exists
        ]);
    
        return redirect()->route('users.all')
            ->with('success', 'User updated successfully');
    }
    
    public function destroy($UserId)
{
    $user = User::findOrFail($UserId);

    

    $user->delete();

    return redirect()->back()->with('success', ' Deleted successfully.');
}
}
