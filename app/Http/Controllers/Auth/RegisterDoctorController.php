<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterDoctorController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|email|max:255|unique:users|unique:doctors',//|unique:doctors
            'phone' => 'required|string|digits:11|unique:users|unique:doctors',//|unique:doctors
            // 'phone' => ['required','digits:11','unique:users'],
            'specialization' => 'required|string|max:255',
            'hospital' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'password' => ['required', 'string', 'confirmed',Password::min(8)->letters()->numbers()->mixedcase()->symbols()],
            // 'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'doctor',
        ]);

        // Create the doctor
        $doctor = Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'specialization' => $request->specialization,
            'hospital' => $request->hospital,
            'room' => $request->room,
            'password' => Hash::make($request->password),
        ]);

        // Assign the user_id column in the users table with the id of the created doctor
        $user->user_id = $doctor->id;
        $user->save();

        // Additional logic can be added here
        return redirect()->back()->with('success', 'Registration successful! Please log in.');
        // return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}
