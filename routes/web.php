<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BillDetailController;
use App\Http\Controllers\BillingSectorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\PDFController;

Route::get('/dashboard', function () {
    return view('new');
    // return view('welcome');
})->middleware(['auth'])->name('new-page');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/fetchDept', [DepartmentController::class, 'getDeptInfo'])
     ->name('fetchDept.data');


require __DIR__ . '/auth.php';


Route::middleware(['auth'])->group(function() {
    Route::get('/bills', [BillDetailController::class, 'bills'])->name('bills.index');
    Route::get('/billDetail', [BillDetailController::class, 'index'])->name('billDetail.index');
    Route::get('/users/all',[AdminController::class, 'allUsers'])->name('users.all');  
});

Route::middleware(['auth'])->group(function() {
    

    Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');

    Route::get('/course', [CourseController::class, 'index'])->name('course.index');
    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/course', [CourseController::class, 'store'])->name('course.store');
    Route::get('/course/{course}/edit', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('/course/{course}/update', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/course/{course}/destroy', [CourseController::class, 'destroy'])->name('course.destroy');

    Route::get('/billDetail/create', [BillDetailController::class, 'create'])->name('billDetail.create');
    // Route::get('/exam', [ExamController::class, 'index'])->name('exam.index');;

    Route::get('/fetchBillingSectorData', [BillingSectorController::class, 'fetchData'])->name('billingSectorFetch.data');

    Route::post('/saveData', [BillDetailController::class, 'saveData'])->name('billDetailSave.data');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function() {
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('/teacher', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('/teacher/{teacher}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('/teacher/{teacher}/update', [TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('/teacher/{UserId}/destroy', [TeacherController::class, 'destroy'])->name('teacher.destroy');
    Route::post('/users/update-role/{role}/{userId}', [AdminController::class, 'updateRole'])->name('users.update-role');
    Route::patch('/users/toggle-status/{id}', [AdminController::class, 'toggleStatus'])->name('user.toggleStatus');

});

Route::get('/bangla-pdf', [PDFController::class, 'generateBanglaPDF'])->name('billDetail.pdf');;
