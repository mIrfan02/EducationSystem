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
}
