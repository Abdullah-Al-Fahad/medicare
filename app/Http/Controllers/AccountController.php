<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Carbon;

class AccountController extends Controller
{
    public function showSettings()
    {
        $user = Auth::user();

        if ($user->isPatient()) {
            return view('account.settings-patient', compact('user'));
        } elseif ($user->isDoctor()) {
            return view('account.settings-doctor', compact('user'));
        }

        return redirect()->back()->with('error', 'Invalid user role.');
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|email|max:255|unique:users,email,' . Auth::id(),
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
            'phone' => 'required|string|digits:11'
            
            // 'email' => 'required|string|email:rfc,dns|email|max:255|unique:users|unique:patients' . Auth::id(),
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled('password')) {
            $request->validate([
                // 'password' => 'required|string|min:8|confirmed',
                'password' => ['required', 'string', 'confirmed',Password::min(8)->letters()->numbers()->mixedcase()->symbols()],
            ]);

            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($user->isPatient()) {
            $patient = $user->patient;
             $patient->name = $request->name; // Update name in patient table
        $patient->email = $request->email; // Update email in patient table
            $patient->phone = $request->phone;
            $patient->location = $request->location;
            $patient->dob = $request->dob;
            $patient->sex = $request->sex;
            $patient->save();
        } elseif ($user->isDoctor()) {
            $doctor = Doctor::where('id', $user->user_id)->first();
            if ($doctor) {
            $doctor->name = $request->name; // Update name in patient table
            $doctor->email = $request->email; // Update email in patient table
            $doctor->phone = $request->phone;
            $doctor->specialization = $request->specialization;
            $doctor->hospital = $request->hospital;
            $doctor->room = $request->room;
            $doctor->save();
            }
            else {
                dd('No doctor associated with the user');
            }
        }

        return redirect()->back()->with('success', 'User information updated successfully.');
    }
}
