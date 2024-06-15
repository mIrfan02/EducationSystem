<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
