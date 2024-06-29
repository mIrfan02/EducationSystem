<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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


    // public function showStudentBookings()
    // {
    //     $studentId = auth()->user()->id;

    //     // Fetch all bookings for the authenticated student
    //     $bookings = Booking::where('student_id', $studentId)->with('meeting')->get();
    //     return view('student.booking', compact('bookings'));
    // }


    public function showStudentBookings()
    {
        $studentId = auth()->user()->id;

        // Fetch all bookings for the authenticated student
        $bookings = Booking::where('student_id', $studentId)->with('meeting')->get();

        foreach ($bookings as $booking) {
            // Calculate session date and time as a Carbon instance
            $sessionDateTime = Carbon::parse($booking->session_date . ' ' . $booking->start_time);

            // Calculate time remaining in seconds
            $timeRemaining = $sessionDateTime->diffInSeconds(now());

            // Store formatted time remaining in booking object
            $booking->time_remaining = $this->formatTimeRemaining($timeRemaining);
        }

        return view('student.booking', compact('bookings'));
    }

    // Helper function to format time remaining
    private function formatTimeRemaining($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function editProfile()
    {
        return view('student.profile');
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicturePath;
        }

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('student.profile.edit')->with('success', 'Profile updated successfully.');
    }


}
