<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Mail\TeacherCredentialsMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{


    public function index(){

        $teachers = User::role('teacher')->get();

        return view('teachers.index', compact('teachers'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:255',
        ]);

        $password = $request->password;

        $teacher = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_no' => $request->contact_no,
            'email' => $request->email,
            'password' => Hash::make($password),

        ]);

        // Assign the teacher role to the user
        $teacher->assignRole('teacher');

        // Send email with login credentials
        Mail::to($teacher->email)->send(new TeacherCredentialsMail($teacher->email, $password));

        Alert::success('Success', 'Teacher  Added Successfully.');

        return redirect()->back();
    }


    public function update(Request $request, User $teacher)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:15', // Adjust the max length as needed
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $teacher->id,
        ]);

        $teacher->update($request->only('first_name', 'last_name', 'contact_no', 'name', 'email'));

        Alert::success('Success', 'Teacher Updated Successfully.');

        return redirect()->back();
    }



    public function destroy(User $teacher)
    {
        $teacher->delete();

        Alert::success('Success', 'Teacher Deleted  Successfully.');

        return redirect()->back();
    }



    public function show($id)
    {
        // Find the teacher by ID
        $teacher = User::findOrFail($id);

        // Get all courses
        $courses = Course::all();

        // Load the assigned courses for the teacher
        $assignedCourses = $teacher->courses()->get();

        return view('teachers.show', compact('teacher', 'courses', 'assignedCourses'));
    }



    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'bio'=> 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('teacher.profile.edit')
            ->withErrors($validator)
            ->withInput();
        }

        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePictureName = time().'.'.$profilePicture->getClientOriginalExtension();
            $profilePicture->move(public_path('profile_pictures'), $profilePictureName);
            $user->profile_picture = $profilePictureName;
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->bio = $request->bio;


        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();
        Alert::success('Success','Profile updated successfully.');

        return redirect()->route('teacher.profile.edit');
    }


    public function edit(){

        $user=User::findOrFail(auth()->user()->id);
        return view('teacher.profile',compact('user'));
    }


    public function reschedule(Request $request, Booking $booking)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'session_date' => 'required|date|after_or_equal:today',
        ]);

        // Update the booking with the new values
        $booking->update([
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            'session_date' => $validatedData['session_date'],
        ]);

        // Redirect back with success message or handle as needed
        Alert::success('Success','Booking rescheduled successfully.');
        return redirect()->back();
    }
}



