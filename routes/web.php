<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BillDetailController;
use App\Http\Controllers\BillingSectorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
// Applying auth middleware to the group of routes
Route::middleware(['auth'])->group(function () {
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('/teacher', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('/teacher/{teacher}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('/teacher/{teacher}/update', [TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('/teacher/{teacher}/destroy', [TeacherController::class, 'destroy'])->name('teacher.destroy');

    Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');

    Route::get('/course', [CourseController::class, 'index'])->name('course.index');
    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/course', [CourseController::class, 'store'])->name('course.store');
    Route::get('/course/{course}/edit', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('/course/{course}/update', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/course/{course}/destroy', [CourseController::class, 'destroy'])->name('course.destroy');


    Route::get('/billDetail', [BillDetailController::class, 'index'])->name('billDetail.index');
    Route::get('/billDetail/create', [BillDetailController::class, 'create'])->name('billDetail.create');
    // Route::get('/exam', [ExamController::class, 'index'])->name('exam.index');;
    Route::get('/fetchBillingSectorData', [BillingSectorController::class, 'fetchData'])->name('billingSectorFetch.data');
    Route::post('/saveData', [BillDetailController::class, 'saveData'])->name('billDetailSave.data');
});
