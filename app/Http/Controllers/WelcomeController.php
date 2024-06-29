<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Wallet;
use App\Models\Booking;
use App\Models\Meeting;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller
{
    public function index(){
        $teachers = User::role('teacher')->get();

        return view('welcome', compact('teachers'));
    }


    public function detail($id){
        $teacher=User::findOrFail($id);

        return view('details',compact('teacher'));
    }


    public function dashboard(){
        $categoryCount = Category::count();
        $courseCount = Course::count();
        $teacherCount = User::role('teacher')->count();

        return view('layouts.dashboard', compact('categoryCount', 'courseCount', 'teacherCount'));
    }


  public function dashboardstudent(){
    {
        $user = Auth::user();

            // Fetch count of bookings fo the authenticated student
            $bookingCount = Booking::where('student_id', $user->id)->count();

            return view('layouts.studentdashbaord', compact('bookingCount'));

    }
  }



  public function dashboardteacher(){
    $teacherId = Auth::id();

    // Fetch the number of sessions
    $sessionCount = Meeting::where('teacher_id', $teacherId)->count();

    // Fetch the number of bookings
    $bookingCount = Booking::where('teacher_id', $teacherId)->count();

    // Fetch wallet information (assuming you have a wallet model and relationship)
    $wallet = Wallet::where('teacher_id', $teacherId)->first();

    return view('layouts.teacherdashboard', compact('sessionCount', 'bookingCount', 'wallet'));
  }


  public function register(){
    return view('auth.register');
  }


  protected function validator(array $data)
  {
      return Validator::make($data, [
          'first_name' => ['required', 'string', 'max:255'],
          'last_name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      ]);
  }

  protected function registerteacher(Request $request)
  {
      $validator = $this->validator($request->all());

      if ($validator->fails()) {
          return redirect()->route('register')
                           ->withErrors($validator)
                           ->withInput();
      }

      $user = User::create([
          'first_name' => $request->input('first_name'),
          'last_name' => $request->input('last_name'),
          'email' => $request->input('email'),
          'password' => 'esol0000', // Dummy password, will be updated later by admin
          'is_teacher'=>'1',
      ]);

      // Use SweetAlert to notify user
      Alert::success('Success', 'Admin will approve your registration. Please wait for further instructions.');

      return redirect()->back();
  }
}



