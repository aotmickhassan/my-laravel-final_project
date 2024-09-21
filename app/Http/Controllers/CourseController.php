<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        // Fetch all courses
        $courses = Course::all();
        return view('courses.index', ['courses' => $courses]);
    }

    public function create()
    {
        // Display form to create a new course
        return view('courses.create');
    }

    public function store(Request $request)
    {
        // Validate form input data for creating a new course
        $data = $request->validate([
            'course_title' => 'required|string|max:255',
            'course_code' => 'required|string|max:50', // Assuming course_code is a field
            'course_credit' => 'required|regex:/^\d+(\.\d{1,2})?$/', // Optional course description
            'course_type' => 'required|string|min:1|max:10', // Example field for course credits
        ]);

        // Create new course using the validated data
        $newCourse = Course::create($data);

        // Redirect to the courses index with success message
        return redirect()->route('course.index')
            ->with('success', 'Course created successfully');
    }

    public function edit(Course $course)
    {
        // Display form to edit the course
        return view('courses.edit', ['course' => $course]);
    }

    public function update(Request $request, Course $course)
    {
        // Validate form input data for updating the course
        $data = $request->validate([
            'course_title' => 'required',
            'course_code' => 'required', // Assuming course_code is a field
            'course_credit' => 'required', // Optional course description
            'course_type' => 'required', // Example field for course credits
        ]);

        // Update the course using the validated data
        $course->update($data);

        // Redirect to the courses index with success message
        return redirect()->route('course.index')
            ->with('success', 'Course updated successfully');
    }

    public function destroy(Course $course)
    {
        // Delete the course
        $course->delete();

        // Redirect to the courses index with success message
        return redirect()->route('course.index')
            ->with('success', 'Course deleted successfully');
    }
}
