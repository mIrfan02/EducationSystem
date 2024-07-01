<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Cart;
use App\Models\User;
use App\Models\Booking;
use App\Models\Meeting;
use Stripe\PaymentIntent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\UserCredentialsMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use App\Mail\StudentBookingConfirmation;
use App\Mail\TeacherBookingNotification;

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
            $user->assignRole('student');
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

    // public function processPayment(Request $request)
    // {

    //     $paymentMethodId = $request->input('payment_method_id');
    //     $userId = $request->input('user_id');
    //     $email = $request->input('email');
    //     $session_id = $request->session()->getId(); // Get current session ID
    //     $totalPrice = $request->input('total_price');

    //     try {
    //         // Set your secret key: remember to change this to your live secret key in production
    //         Stripe::setApiKey(config('services.stripe.secret'));

    //         // Start a transaction to ensure data consistency
    //         DB::beginTransaction();

    //         try {
    //             // Fetch cart items based on current session ID
    //             $cartItems = Cart::where('session_id', $session_id)->get();

    //             // Calculate total amount in cents for the PaymentIntent
    //             $totalAmount = $totalPrice * 100; // Assuming total_price is in dollars

    //             // Create a Stripe PaymentIntent with return_url
    //             $paymentIntent = \Stripe\PaymentIntent::create([
    //                 'amount' => $totalAmount,
    //                 'currency' => 'usd',
    //                 'payment_method' => $paymentMethodId,
    //                 'confirm' => true,
    //                 'description' => 'Booking payment',
    //                 'receipt_email' => $email,
    //                 'return_url' => route('payment.success'), // Replace with your success route
    //             ]);

    //             foreach ($cartItems as $cartItem) {
    //                 // Retrieve the meeting details for booking
    //                 $meeting = Meeting::findOrFail($cartItem->meeting_id);

    //                 // Create a new booking record (assuming payment is successful)
    //                 $booking = Booking::create([
    //                     'student_id' => $userId,
    //                     'teacher_id' => $meeting->teacher_id,
    //                     'meeting_id' => $meeting->id,
    //                     'booking_date' => now(),
    //                     'session_date' => $meeting->date,
    //                     'start_time' => $meeting->start_time,
    //                     'end_time' => $meeting->end_time,
    //                     'status' => 'pending',
    //                     'comments' => 'Booking created via payment',
    //                 ]);

    //                 // Optionally, you can remove the item from the cart after booking
    //                 $cartItem->delete();
    //             }

    //             // Commit the transaction if everything is successful
    //             DB::commit();

    //             // Handle post-booking tasks like sending emails, notifications, etc.

    //             // Redirect to payment.success route with success message
    //             return response()->json(['success' => true, 'redirect' => route('payment.success')]);
    //         } catch (\Exception $e) {
    //             // Rollback the transaction if there's an error
    //             DB::rollback();

    //             return response()->json(['success' => false, 'message' => 'Booking creation failed: ' . $e->getMessage()]);
    //         }
    //     } catch (CardException $e) {
    //         // Payment failed (card declined, etc.)
    //         return response()->json(['success' => false, 'message' => 'Card declined: ' . $e->getMessage()]);
    //     } catch (\Exception $e) {
    //         // Generic error handling
    //         return response()->json(['success' => false, 'message' => 'Payment failed: ' . $e->getMessage()]);
    //     }
    // }

//     public function processPayment(Request $request)
// {
//     $paymentMethodId = $request->input('payment_method_id');
//     $userId = $request->input('user_id');
//     $email = $request->input('email');
//     $session_id = $request->session()->getId(); // Get current session ID
//     $totalPrice = $request->input('total_price');

//     try {
//         // Set your secret key: remember to change this to your live secret key in production
//         Stripe::setApiKey(config('services.stripe.secret'));

//         // Start a transaction to ensure data consistency
//         DB::beginTransaction();

//         try {
//             // Fetch cart items based on current session ID
//             $cartItems = Cart::where('session_id', $session_id)->get();

//             // Calculate total amount in cents for the PaymentIntent
//             $totalAmount = $totalPrice * 100; // Assuming total_price is in dollars

//             // Create a Stripe PaymentIntent with return_url
//             $paymentIntent = \Stripe\PaymentIntent::create([
//                 'amount' => $totalAmount,
//                 'currency' => 'usd',
//                 'payment_method' => $paymentMethodId,
//                 'confirm' => true,
//                 'description' => 'Booking payment',
//                 'receipt_email' => $email,
//                 'return_url' => route('payment.success'), // Replace with your success route
//             ]);

//             foreach ($cartItems as $cartItem) {
//                 // Retrieve the meeting details for booking
//                 $meeting = Meeting::findOrFail($cartItem->meeting_id);

//                 // Create a new booking record (assuming payment is successful)
//                 $booking = Booking::create([
//                     'student_id' => $userId,
//                     'teacher_id' => $meeting->teacher_id,
//                     'meeting_id' => $meeting->id,
//                     'booking_date' => now(),
//                     'session_date' => $meeting->date,
//                     'start_time' => $meeting->start_time,
//                     'end_time' => $meeting->end_time,
//                     'status' => 'pending',
//                     'comments' => 'Booking created via payment',
//                 ]);

//                 // Optionally, you can remove the item from the cart after booking
//                 $cartItem->delete();
//             }

//             // Commit the transaction if everything is successful
//             DB::commit();

//             // Redirect to payment.success route with success message
//             return response()->json(['success' => true, 'redirect' => route('payment.success')]);
//         } catch (\Exception $e) {
//             // Rollback the transaction if there's an error
//             DB::rollback();

//             return response()->json(['success' => false, 'message' => 'Booking creation failed: ' . $e->getMessage()]);
//         }
//     } catch (CardException $e) {
//         // Payment failed (card declined, etc.)
//         return response()->json(['success' => false, 'message' => 'Card declined: ' . $e->getMessage()]);
//     } catch (\Exception $e) {
//         // Generic error handling
//         return response()->json(['success' => false, 'message' => 'Payment failed: ' . $e->getMessage()]);
//     }
// }


public function processPayment(Request $request)
{
    $paymentMethodId = $request->input('payment_method_id');
    $userId = $request->input('user_id');
    $email = $request->input('email');
    $session_id = $request->session()->getId(); // Get current session ID
    $totalPrice = $request->input('total_price');

    try {
        // Set your secret key: remember to change this to your live secret key in production
        Stripe::setApiKey(config('services.stripe.secret'));

        // Start a transaction to ensure data consistency
        DB::beginTransaction();

        try {
            // Fetch cart items based on current session ID
            $cartItems = Cart::where('session_id', $session_id)->get();

            // Calculate total amount in cents for the PaymentIntent
            $totalAmount = $totalPrice * 100; // Assuming total_price is in dollars

            // Create a Stripe PaymentIntent with return_url
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $totalAmount,
                'currency' => 'usd',
                'payment_method' => $paymentMethodId,
                'confirm' => true,
                'description' => 'Booking payment',
                'receipt_email' => $email,
                'return_url' => route('payment.success'), // Replace with your success route
            ]);

            foreach ($cartItems as $cartItem) {
                // Retrieve the meeting details for booking
                $meeting = Meeting::findOrFail($cartItem->meeting_id);

                // Create a new booking record (assuming payment is successful)
                $booking = Booking::create([
                    'student_id' => $userId,
                    'teacher_id' => $meeting->teacher_id,
                    'meeting_id' => $meeting->id,
                    'booking_date' => now(),
                    'session_date' => $meeting->date,
                    'start_time' => $meeting->start_time,
                    'end_time' => $meeting->end_time,
                    'status' => 'paid',
                    'comments' => 'Booking created via payment',
                ]);

                // Send booking confirmation email to the student
                Mail::to($email)->send(new StudentBookingConfirmation($meeting));

                // Send booking notification email to the teacher
                $teacherEmail = User::findOrFail($meeting->teacher_id)->email;
                Mail::to($teacherEmail)->send(new TeacherBookingNotification($meeting));

                // Optionally, you can remove the item from the cart after booking
                $cartItem->delete();
            }

            // Commit the transaction if everything is successful
            DB::commit();

            // Redirect to payment.success route with success message
            return response()->json(['success' => true, 'redirect' => route('welcome.index')]);
        } catch (\Exception $e) {
            // Rollback the transaction if there's an error
            DB::rollback();

            return response()->json(['success' => false, 'message' => 'Booking creation failed: ' . $e->getMessage()]);
        }
    } catch (CardException $e) {
        // Payment failed (card declined, etc.)
        return response()->json(['success' => false, 'message' => 'Card declined: ' . $e->getMessage()]);
    } catch (\Exception $e) {
        // Generic error handling
        return response()->json(['success' => false, 'message' => 'Payment failed: ' . $e->getMessage()]);
    }
}


}
