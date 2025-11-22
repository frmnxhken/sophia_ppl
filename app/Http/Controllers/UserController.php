<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        return view("profile.index");
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required|unique:users,email," . $user->id,
            "photo" => "nullable"
        ]);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;

        if ($request->hasFile("photo")) {
            $file = $request->file("photo");
            $fileName = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path("photos"), $fileName);
            $user->photo = "/photos/" . $fileName;
        }

        $user->save();
        return back()->with("success", "Profile updated!");
    }

    public function changePassword()
    {
        return view("profile.password");
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'min:4', 'confirmed'],
        ], [
            'password.confirmed' => 'Password confirmation does not match.'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }
}
