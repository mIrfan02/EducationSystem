<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Commission;
use App\Models\CourseTeacher;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commissions = Commission::all();
        $courses = Course::all();
        $teachers = User::role('teacher')->get();
        return view('commission.index', compact('commissions', 'courses', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'rate' => 'required|numeric',
            'session_fee' => 'required|numeric',
            'teacher_id' => 'required|exists:users,id|unique:commissions,teacher_id', // Validate against users table and ensure teacher_id is unique in commissions table
        ]);

        // Create commission using validated data
        Commission::create([
            'rate' => $request->rate,
            'session_fee' => $request->session_fee,
            'teacher_id' => $request->teacher_id,
        ]);

        // Display SweetAlert message for success
        Alert::success('Success', 'Commission created successfully!')->persistent(true);

        // Redirect back to commissions index page
        return redirect()->route('commissions.index');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commission $commission)
    {
        $request->validate([
            'rate' => 'required|numeric',
            'session_fee' => 'required|numeric', // Validate the session_fee field

            'course_id' => 'required|exists:courses,id',
        ]);

        $commission->update($request->all());

        // Display SweetAlert message
        Alert::success('Success', 'Commission updated successfully!')->persistent(true);

        return redirect()->route('commissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commission $commission)
    {
        $commission->delete();

        // Display SweetAlert message
        Alert::success('Success', 'Commission deleted successfully!')->persistent(true);

        return redirect()->route('commissions.index');
    }


    public function getSessionFee($id)
    {
        $commission = Commission::where('teacher_id', $id)->first();

        if ($commission) {
            return response()->json(['session_fee' => $commission->session_fee]);
        }

        return response()->json(['session_fee' => 0], 404); // Return 0 if no commission found
    }
}
