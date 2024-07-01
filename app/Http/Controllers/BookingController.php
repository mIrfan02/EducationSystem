<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Commission;
use Illuminate\Http\Request;
use App\Models\StudentWallet;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function getTeacherBookings()
    {
        $teacherId = Auth::id(); // Get the logged-in teacher's ID

        // Fetch bookings for the logged-in teacher
        $bookings = Booking::where('teacher_id', $teacherId)->with('meeting', 'student')->get();

        foreach ($bookings as $booking) {
            // Calculate session date and time as a Carbon instance
            $sessionDateTime = Carbon::parse($booking->session_date . ' ' . $booking->start_time);

            // Calculate time remaining in seconds
            $timeRemaining = $sessionDateTime->diffInSeconds(now());

            // Store formatted time remaining in booking object
            $booking->time_remaining = $this->formatTimeRemaining($timeRemaining);
        }

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
            // Calculate session start and end times as Carbon instances
            $sessionStartDateTime = Carbon::parse($booking->session_date . ' ' . $booking->start_time);
            $sessionEndDateTime = Carbon::parse($booking->session_date . ' ' . $booking->end_time);

            // Calculate time remaining in seconds
            $timeRemaining = $sessionStartDateTime->diffInSeconds(now());

            // Store formatted time remaining in booking object
            $booking->time_remaining = $this->formatTimeRemaining($timeRemaining);

            // Determine if the booking can be canceled (if the meeting is in the future)
            $booking->isCancelable = $sessionStartDateTime->isFuture();

            // Determine if the session is currently in progress
            $booking->isInProgress = now()->between($sessionStartDateTime, $sessionEndDateTime);
        }

        return view('student.booking', compact('bookings'));
    }

    public function cancelBooking($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        $studentId = auth()->user()->id;

        if ($booking->student_id != $studentId) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $sessionStartDateTime = Carbon::parse($booking->session_date . ' ' . $booking->start_time);

        if ($sessionStartDateTime->isPast()) {
            return redirect()->back()->with('error', 'Cannot cancel an ongoing or past meeting.');
        }

        $meeting = $booking->meeting;
        $feePerHour = $meeting->fee_per_hour;

        $studentWallet = StudentWallet::firstOrCreate(['student_id' => $studentId]);
        $studentWallet->balance += $feePerHour;
        $studentWallet->save();

        $booking->delete();

        return redirect()->back()->with('success', 'Booking canceled and amount added to your wallet.');
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

    public function showBookingsWithCommission()
    {
        // Fetch all bookings with related meetings
        $bookings = Booking::with('meeting')->get();

        // Calculate earnings after commission for each booking
        $bookingsWithEarnings = $bookings->map(function ($booking) {
            $meeting = $booking->meeting;
            $feePerHour = $meeting->fee_per_hour;

            // Fetch the commission rate for the teacher
            $commission = Commission::where('teacher_id', $booking->teacher_id)->first();
            $commissionRate = $commission ? $commission->rate : 0;

            // Calculate the earnings after applying the commission rate
            $commissionAmount = ($feePerHour * $commissionRate) / 100;
            $earningsAfterCommission = $feePerHour - $commissionAmount;

            $booking->commission_rate = $commissionRate;
            $booking->earnings_after_commission = $earningsAfterCommission;
            $booking->commission_amount = $commissionAmount;

            return $booking;
        });

        return view('booking.finance', compact('bookingsWithEarnings'));
    }

    public function overviewBookings()
    {
        // Fetch all bookings with related meeting, teacher, and student data
        $bookings = Booking::with(['teacher', 'meeting', 'student'])->get();

        return view('booking.overview_bookings', compact('bookings'));
    }

}
