<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\TeacherApproved;
use App\Models\WithdrawalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function editProfile()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update name and email
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Update password if provided
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        Alert::success('Success', 'Profile updated successfully.');

        return redirect()->back();
    }


    public function showWithdrawalRequests()
    {
        $withdrawalRequests = WithdrawalRequest::with('teacher')->get();
        return view('withdraw.index', compact('withdrawalRequests'));
    }


    public function approveWithdrawalRequest(Request $request, $id)
{
    $withdrawalRequest = WithdrawalRequest::find($id);

    if (!$withdrawalRequest) {
        return redirect()->route('admin.withdrawal_requests')->with('error', 'Withdrawal request not found.');
    }

    if ($withdrawalRequest->status !== 'pending') {
        return redirect()->route('admin.withdrawal_requests')->with('error', 'Withdrawal request is not pending.');
    }

    $wallet = Wallet::where('teacher_id', $withdrawalRequest->teacher_id)->first();

    if (!$wallet) {
        return redirect()->route('admin.withdrawal_requests')->with('error', 'Teacher wallet not found.');
    }

    if ($wallet->balance < $withdrawalRequest->amount) {
        return redirect()->route('admin.withdrawal_requests')->with('error', 'Insufficient balance in teacher\'s wallet.');
    }

    // Deduct amount and update status
    // $wallet->balance -= $withdrawalRequest->amount;
    $wallet->deduct_balance += $withdrawalRequest->amount;
    $wallet->save();

    $withdrawalRequest->status = 'approved';
    $withdrawalRequest->save();

    return redirect()->route('admin.withdrawal_requests')->with('success', 'Withdrawal request approved successfully.');
}



public function approveTeacher()
    {
        // Fetch all users where is_teacher is 1
        $teachers = User::where('is_teacher', '1')->get();

        return view('approveteacher.index', ['teachers' => $teachers]);
    }


    public function approveTeachers(Request $request, $id)
    {
        $teacher = User::findOrFail($id);
        $password = Str::random(6);
        $hashedPassword = Hash::make($password);

        // Update the teacher's record
        $teacher->is_teacher = '0';
        $teacher->password = $hashedPassword;
        $teacher->save();

        // Assign the "teacher" role
        $teacher->assignRole('teacher');

        // Prepare email data
        $email = $teacher->email;
        $name = $teacher->first_name . ' ' . $teacher->last_name;
        $loginUrl = route('login');

        // Send the email
        Mail::to($email)->send(new TeacherApproved($email, $name, $password, $loginUrl));

        // Redirect back with a success message
        Alert::success('Success', 'Teacher approved and credentials sent.');
        return redirect()->back();
    }

}
