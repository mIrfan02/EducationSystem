<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Mail\TeacherCredentialsMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

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
}
