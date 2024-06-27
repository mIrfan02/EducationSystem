<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\WithdrawalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    $wallet->balance -= $withdrawalRequest->amount;
    $wallet->save();

    $withdrawalRequest->status = 'approved';
    $withdrawalRequest->save();

    return redirect()->route('admin.withdrawal_requests')->with('success', 'Withdrawal request approved successfully.');
}


}
