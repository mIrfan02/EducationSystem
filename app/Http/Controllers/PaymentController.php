<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\User;
use Stripe\PaymentIntent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\UserCredentialsMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function registerTempUser(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
            ]);

            $password = Str::random(6);

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($password),
            ]);

            Mail::to($user->email)->send(new UserCredentialsMail($user->email, $password));

            return response()->json(['user_id' => $user->id]);
        } catch (\Exception $e) {
            Log::error('Failed to register user: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['error' => 'Failed to register user.'], 500);
        }
    }

    public function checkout($user_id)
    {
        $user = User::findOrFail($user_id);
        if (!$user) {
            return redirect('/')->with('error', 'User not found.');
        }

        return view('checkout', [
            'user' => $user,
        ]);
    }


    // public function checkout()
    // {
    //     $user_id = session('user_id');
    //     $total_price = session('total_price');

    //     if (!$user_id || !$total_price) {
    //         return redirect('/')->with('error', 'User ID or total price missing in session.');
    //     }

    //     $user = User::findOrFail($user_id);

    //     return view('checkout', compact('user', 'total_price'));
    // }

    public function processPayment(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $paymentIntent = PaymentIntent::create([
                'amount' => $request->total_price * 100, // Stripe requires amount in cents
                'currency' => 'usd', // Change as per your currency
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'description' => 'Payment for services',
                'metadata' => [
                    'user_id' => $request->user_id,
                    'email' => $request->email,
                ],
            ]);

            return response()->json(['success' => true]);
        } catch (CardException $e) {
            Log::error('Stripe Card Error: ' . $e->getMessage());
            return response()->json(['error' => 'Payment failed. Please check your card details and try again.'], 500);
        } catch (\Exception $e) {
            Log::error('Stripe Error: ' . $e->getMessage());
            return response()->json(['error' => 'Payment failed. Please try again later.'], 500);
        }
    }
}
