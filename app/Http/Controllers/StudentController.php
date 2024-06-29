<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function editProfile()
    {
        return view('student.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('student.profile.edit')
                ->withErrors($validator)
                ->withInput();
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePictureName = time().'.'.$profilePicture->getClientOriginalExtension();
            $profilePicture->move(public_path('profile_pictures'), $profilePictureName);
            $user->profile_picture = $profilePictureName;
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();
        Alert::Success('Success','Profile updated successfully.');

        return redirect()->back();
    }
}
