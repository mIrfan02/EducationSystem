<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentWallet;
use App\Models\WithdrawalRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentWithdrawalRequest;
use RealRashid\SweetAlert\Facades\Alert;

class StudentWithdrawalRequestController extends Controller
{
    public function index()
    {
        $studentId = Auth::id();
        $withdrawalRequests = StudentWithdrawalRequest::where('student_id', $studentId)->get();

        return view('student.withdraw', compact('withdrawalRequests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_number' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $studentId = Auth::id();
        $wallet = StudentWallet::where('student_id', $studentId)->first();

        if (!$wallet) {
            Alert::error('Error','Student wallet not found.');
            return redirect()->back();
        }


        $currentBalance = $wallet->balance;

        // Check if requested amount is greater than current balance
        if ($request->amount > $currentBalance) {
            Alert::error('Error','Withdrawal amount cannot exceed wallet balance.');
            return redirect()->back();
        }


        // Proceed with creating withdrawal request
        StudentWithdrawalRequest::create([
            'student_id' => $studentId,
            'account_number' => $request->account_number,
            'amount' => $request->amount,
            'status' => 'pending', // Set initial status
        ]);

        Alert::success('Success', 'Withdrawal request submitted successfully.');
        return redirect()->back();
    }

    public function showWithdrawalRequests()
{
    $withdrawalRequests = StudentWithdrawalRequest::all();

    return view('withdraw.student_withdraw', compact('withdrawalRequests'));
}

public function student_withdraw_request($id)
{
    // Find the withdrawal request by ID
    $request = StudentWithdrawalRequest::findOrFail($id);

    // Deduct the amount from the student's wallet
    $studentWallet = StudentWallet::where('student_id', $request->student_id)->firstOrFail();

    // Check if the wallet balance is sufficient
    if ($studentWallet->balance >= $request->amount) {
        // Deduct the amount
        $studentWallet->balance -= $request->amount;
        $studentWallet->save();

        // Update the request status to Approved
        $request->update(['status' => 'Approved']);
        Alert::success('Success', 'Withdrawal request approved and amount deducted from student wallet.');
        return redirect()->back();
    } else {
        Alert::success('Error', 'Insufficient balance in student wallet.');

        return redirect()->back();
    }
}


}
