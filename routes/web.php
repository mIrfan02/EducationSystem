<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseTeacherController;

// Authentication routes
Auth::routes();

// Public route


// Auth and Admin middleware group
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/', function () {
        return view('layouts.dashboard');
    })->name('index');


    Route::get('/admin/profile', [AdminController::class, 'editProfile'])->name('profile.edit');
    Route::put('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');



    // Category routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Course routes
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');

    // Teacher routes
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/teachers/{id}', [TeacherController::class, 'show'])->name('teachers.show');
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

    // CourseTeacher routes
    Route::post('/teachers/{teacher}/assign-course', [CourseTeacherController::class, 'assignCourse'])->name('assign-course');
    Route::put('/teachers/{teacher}/course/{pivot_id}', [CourseTeacherController::class, 'update'])->name('teacher.courses.update');
    Route::delete('/teachers/{teacher}/courses/{course}', [CourseTeacherController::class, 'destroy'])->name('teachers.courses.delete');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {

    Route::get('/', function () {
        return view('layouts.dashboard');
    })->name('index');


});





// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
