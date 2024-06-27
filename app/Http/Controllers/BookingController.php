<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function getTeacherBookings()
    {
        $teacherId = Auth::id(); // Get the logged-in teacher's ID

        // Fetch bookings for the logged-in teacher
        $bookings = Booking::where('teacher_id', $teacherId)->with('meeting', 'student')->get();

        return view('booking.index', compact('bookings'));
    }


    public function showStudentBookings()
    {
        $studentId = auth()->user()->id;

        // Fetch all bookings for the authenticated student
        $bookings = Booking::where('student_id', $studentId)->with('meeting')->get();
        return view('student.booking', compact('bookings'));
    }



}
