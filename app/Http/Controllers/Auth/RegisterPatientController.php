<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Carbon;

class RegisterPatientController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|email|max:255|unique:users|unique:patients',//|unique:patients
            'phone' => 'required|string|digits:11|unique:users|unique:patients',//|unique:patients
            'location' => 'required|string|max:255',
            // 'dob' => 'required|date',
            'dob' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $selectedDate = Carbon::parse($value);
            
                    if ($selectedDate->isFuture()) {
                        $fail('Date of birth cannot be a future date.');
                    }
                },
            ],
            'sex' => 'required|string',
            // 'password' => 'required|string|min:8|confirmed',
            'password' => ['required', 'string', 'confirmed',Password::min(8)->letters()->numbers()->mixedcase()->symbols()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'patient', // Set the role to "patient"
        ]);

        $patient = Patient::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'location' => $request->location,
            'dob' => $request->dob,
            'sex' => $request->sex,
            'password' => Hash::make($request->password),
        ]);

        $user->user_id = $patient->id;
        $user->save();


        // additional logic here, such as sending a verification email
        return redirect()->back()->with('success', 'Registration successful! Please log in.');

        // return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}
