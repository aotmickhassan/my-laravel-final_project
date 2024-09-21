<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
Route::post('/teacher', [TeacherController::class, 'store'])->name('teacher.store');
Route::get('/teacher/{teacher}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
Route::put('/teacher/{teacher}/update', [TeacherController::class, 'update'])->name('teacher.update');
Route::delete('/teacher/{teacher}/destroy', [TeacherController::class, 'destroy'])->name('teacher.destroy');

// Route to list all courses
Route::get('/course', [CourseController::class, 'index'])->name('course.index');

// Route to display the form to create a new course
Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');

// Route to handle the submission of a new course
Route::post('/course', [CourseController::class, 'store'])->name('course.store');

// Route to display the form to edit an existing course
Route::get('/course/{course}/edit', [CourseController::class, 'edit'])->name('course.edit');

// Route to handle updating the course's details
Route::put('/course/{course}/update', [CourseController::class, 'update'])->name('course.update');

// Route to handle deleting a course
Route::delete('/course/{course}/destroy', [CourseController::class, 'destroy'])->name('course.destroy');






// Route::middleware(['auth'])->group(function () {
//     // Teacher routes
//     Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
//     Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
//     Route::post('/teacher', [TeacherController::class, 'store'])->name('teacher.store');
//     Route::get('/teacher/{teacher}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
//     Route::put('/teacher/{teacher}/update', [TeacherController::class, 'update'])->name('teacher.update');
//     Route::delete('/teacher/{teacher}/destroy', [TeacherController::class, 'destroy'])->name('teacher.destroy');
// });