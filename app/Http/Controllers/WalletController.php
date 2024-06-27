<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Booking;
use App\Models\Meeting;
use App\Models\Commission;
use Illuminate\Http\Request;
use App\Models\WithdrawalRequest;

class WalletController extends Controller
{
    /**
     * Display wallet details and update commission details.
     *
     * @return \Illuminate\Http\Response
     */
    public function showWallet()
    {
        $teacherId = auth()->user()->id;

        // Update commission details and wallet balance
        $this->updateWalletBalance($teacherId);
        $withdrawalRequests = WithdrawalRequest::where('teacher_id', $teacherId)->get();
        // Fetch commission detail and wallet balance for display
        $wallet = Wallet::where('teacher_id', $teacherId)->first();
        $totalEarningsBeforeCommission = $this->calculateTotalEarningsBeforeCommission($teacherId);
        $commissionRate = Commission::where('teacher_id', $teacherId)->value('rate') ?? 0;

        return view('wallet.index', compact('wallet','withdrawalRequests', 'totalEarningsBeforeCommission', 'commissionRate'));
    }

    /**
     * Calculate total earnings before applying commission.
     *
     * @param  int  $teacherId
     * @return float
     */
    private function calculateTotalEarningsBeforeCommission($teacherId)
    {
        // Fetch all bookings for the teacher with related meetings
        $bookings = Booking::where('teacher_id', $teacherId)->with('meeting')->get();

        // Initialize variable for total earnings before commission
        $totalEarningsBeforeCommission = 0;

        // Iterate through each booking
        foreach ($bookings as $booking) {
            // Assuming 'meeting' is the relationship method to fetch related meeting
            $meeting = $booking->meeting;

            // Check if meeting exists and has fee_per_hour
            if ($meeting && isset($meeting->fee_per_hour)) {
                // Accumulate total earnings before commission
                $totalEarningsBeforeCommission += $meeting->fee_per_hour;
            }
        }

        return $totalEarningsBeforeCommission;
    }

    /**
     * Update wallet balance after commission deduction.
     *
     * @param  int  $teacherId
     * @return void
     */
    private function updateWalletBalance($teacherId)
    {
        // Fetch all bookings for the teacher with related meetings
        $bookings = Booking::where('teacher_id', $teacherId)->with('meeting')->get();

        // Initialize variables for total earnings and total amount deducted
        $totalEarnings = 0;

        // Iterate through each booking
        foreach ($bookings as $booking) {
            // Assuming 'meeting' is the relationship method to fetch related meeting
            $meeting = $booking->meeting;

            // Check if meeting exists and has fee_per_hour
            if ($meeting && isset($meeting->fee_per_hour)) {
                // Fetch commission rate for this specific teacher from Commission model
                $commissionRate = Commission::where('teacher_id', $teacherId)->value('rate') ?? 0;

                // Calculate earnings after commission deduction
                $earningsAfterCommission = $meeting->fee_per_hour * (1 - ($commissionRate / 100));

                // Update total earnings
                $totalEarnings += $earningsAfterCommission;
            }
        }

        // Update or create the wallet balance
        Wallet::updateOrCreate(
            ['teacher_id' => $teacherId],
            ['balance' => $totalEarnings]
        );
    }


    public function withdraw(Request $request)
    {
        $teacherId = auth()->user()->id;
        $wallet = Wallet::where('teacher_id', $teacherId)->first();

        // Validate withdrawal amount
        $request->validate([
            'withdraw_amount' => 'required|numeric|min:0.01|max:' . $wallet->balance,
        ]);

        // Create withdrawal request
        WithdrawalRequest::create([
            'teacher_id' => $teacherId,
            'amount' => $request->withdraw_amount,
            'status' => 'pending',
        ]);

        return redirect()->route('wallet.show')->with('success', 'Withdrawal request submitted successfully.');
    }

}
