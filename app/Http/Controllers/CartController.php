<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Alert;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Get the current session ID
        $sessionId = $request->session()->getId();

        // Validate request
        $validator = Validator::make($request->all(), [
            'meeting_id' => 'required|exists:meetings,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
        }

        // Check if the meeting is already in the cart
        $cartItem = Cart::where('session_id', $sessionId)
                        ->where('meeting_id', $request->meeting_id)
                        ->first();

        if (!$cartItem) {
            // If the meeting is not in the cart, create a new cart item
            Cart::create([
                'session_id' => $sessionId,
                'meeting_id' => $request->meeting_id,
            ]);

            // Return JSON response with success message
            return response()->json(['status' => 'success', 'message' => 'Meeting added to cart successfully!']);
        } else {
            // Return JSON response with error message
            return response()->json(['status' => 'error', 'message' => 'Meeting already in the cart!']);
        }
    }
    public function fetchCartItems()
    {
        // Get current session ID
        $sessionId = session()->getId();

        // Fetch cart items for the current session
        $cartItems = Cart::where('session_id', $sessionId)
                         ->with('meeting') // Assuming you have a relationship defined for meetings
                         ->get();

        return response()->json($cartItems);
    }


    // Method to delete an item from the cart
    public function deleteCartItem($id)
    {
        $cartItem = Cart::find($id);

        if (!$cartItem) {
            return response()->json(['error' => 'Cart item not found.'], 404);
        }

        $cartItem->delete();

        return response()->json(['message' => 'Cart item deleted successfully.']);
    }




}
