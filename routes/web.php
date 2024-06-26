<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\CourseTeacherController;
use App\Http\Controllers\StudentWithdrawalRequestController;


// Authentication routes
Auth::routes();

// Route::get('/auth/check', function () {
//     return response()->json(['authenticated' => Auth::check()]);
// });

// In your routes/web.php or api.php
Route::get('/auth/check', function () {
    if (Auth::check()) {
        return response()->json(['authenticated' => true, 'user_id' => Auth::id()]);
    } else {
        return response()->json(['authenticated' => false]);
    }
});




// Public route
// Route::get('/', function () {
//     return view('welcome');
// })->name('index');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
Route::get('/details/{id}', [WelcomeController::class, 'detail'])->name('details');

Route::post('/cart/add', [CartController::class, 'addToCart']);
Route::get('/cart/items', [CartController::class, 'fetchCartItems']);
Route::delete('/cart/delete/{id}', [CartController::class, 'deleteCartItem']);

Route::post('/register-temp-user', [PaymentController::class, 'registerTempUser']);

Route::get('/checkout/{user_id}', [PaymentController::class, 'checkout'])->name('checkout');

// Route::get('/stripe/checkout', [StripePaymentController::class, 'checkout'])->name('stripe.checkout');

Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');
// routes/web.php

Route::get('/register/teacher', [WelcomeController::class, 'register'])->name('teacher.register');


Route::post('/register/teacher', [WelcomeController::class, 'registerteacher'])->name('teacher.registerteacher');



Route::get('/payment/success', function () {
    return view('payment.success');
})->name('payment.success');


// Route::get('/dashboard', function () {
//     return view('layouts.dashboard');
// })->name('index')->middleware('auth');
// Auth and Admin middleware group
Route::middleware(['auth', 'role:admin'])->group(function () {


    Route::get('/dashboard', [WelcomeController::class, 'dashboard'])->name('index');

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
    Route::resource('commissions', CommissionController::class);

    Route::get('/admin/withdrawal-requests', [AdminController::class, 'showWithdrawalRequests'])->name('admin.withdrawal_requests');
    Route::post('/admin/withdrawal-requests/{id}/approve', [AdminController::class, 'approveWithdrawalRequest'])->name('admin.approve_withdrawal_request');



    Route::get('/admin/approve/teachers', [AdminController::class, 'approveTeacher'])->name('admin.approve.teacher');
    Route::post('/admin/approve/teacher/{id}', [AdminController::class, 'approveTeachers'])->name('approve.teachers');

    Route::get('/admin/bookings-with-commission', [BookingController::class, 'showBookingsWithCommission'])->name('admin.bookings_with_commission');

    // Route to show overview of bookings to the admin
Route::get('/admin/overview-bookings', [BookingController::class, 'overviewBookings'])->name('admin.overview_bookings');
Route::get('/student/withdrawal', [StudentWithdrawalRequestController::class, 'showWithdrawalRequests'])->name('student.requests');
Route::post('/student/withdrawalpending/request/{id}', [StudentWithdrawalRequestController::class, 'student_withdraw_request'])->name('admin.student_withdraw_request');


});

Route::middleware(['auth', 'role:teacher'])->group(function () {

    // Route::get('/dashboard', function () {
    //     return view('layouts.dashboard');
    // })->name('index');
    Route::get('/dashboard/teacher', [WelcomeController::class, 'dashboardteacher'])->name('teacher.index');

    Route::get('/sessions', [MeetingController::class, 'index'])->name('sessions.index');
    Route::post('/sessions', [MeetingController::class, 'store'])->name('sessions.store');
    Route::get('/sessions/{session}', [MeetingController::class, 'show'])->name('sessions.show');
    Route::put('/sessions/{id}', [MeetingController::class, 'update'])->name('sessions.update');
    Route::delete('/sessions/{id}', [MeetingController::class, 'destroy'])->name('sessions.destroy');


    Route::get('/teacher/profile', [TeacherController::class, 'edit'])->name('teacher.profile.edit');
    Route::put('/teacher/profile/update', [TeacherController::class, 'updateProfile'])->name('teacher.profile.update');

    Route::get('/teacher/bookings', [BookingController::class, 'getTeacherBookings'])->name('teacher.bookings');


    Route::get('/teacher/{id}/session-fee', [CommissionController::class, 'getSessionFee'])->name('teacher.session-fee');


    Route::get('/teacher/wallet', [WalletController::class, 'showWallet'])->name('wallet.show');

    Route::post('/teacher/wallet/withdraw', [WalletController::class, 'withdraw'])->name('wallet.withdraw');


    Route::post('/teacher/reschedule/{booking}', [TeacherController::class, 'reschedule'])->name('teacher.reschedule');



});



Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/dashboard/student', [WelcomeController::class, 'dashboardstudent'])->name('student.index');


    Route::get('/student/bookings', [BookingController::class, 'showStudentBookings'])->name('student.bookings');

    Route::delete('/student/bookings/{id}', [BookingController::class, 'cancelBooking'])->name('student.cancel_booking');

    Route::get('/student/profile', [StudentController::class, 'editProfile'])->name('student.profile.edit');
    Route::put('/student/profile', [StudentController::class, 'updateProfile'])->name('student.profile.update');


    Route::get('/student/withdrawal-requests', [StudentWithdrawalRequestController::class, 'index'])->name('student.withdrawal_requests');
    Route::post('/student/withdraw', [StudentWithdrawalRequestController::class, 'store'])->name('student.withdrawal_request.store');



});





// Home route
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
