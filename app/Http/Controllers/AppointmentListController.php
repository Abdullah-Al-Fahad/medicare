<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

class AppointmentListController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'patient') {
            return $this->indexForPatient($user);
        } elseif ($user->role === 'doctor') {
            return $this->indexForDoctor($user);
        } else {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
    }

    private function indexForPatient($user)
    {
        $appointments = Appointment::where('patient_id', $user->user_id)->get();
        return view('patient.list', compact('appointments'));
    }

    private function indexForDoctor($user)
    {
        $appointments = Appointment::join('users', 'appointments.patient_id', '=', 'users.id')
        ->where('appointments.doctor_id', $user->user_id)
        ->select('appointments.*', 'users.name as patient_name')
        ->get();

        return view('doctor.list', compact('appointments'));
    }

    public function destroy(Appointment $appointment)
    {
        $user = Auth::user();

        if ($user->role === 'patient' && $user->user_id != $appointment->patient_id) {
            return redirect()->back()->with('error', 'You are not authorized to remove this appointment.');
        }

        if ($user->role === 'doctor' && $user->user_id != $appointment->doctor_id) {
            return redirect()->back()->with('error', 'You are not authorized to remove this appointment.');
        }

        $appointment->delete();

        return redirect()->back()->with('success', 'Appointment removed successfully.');
    }
}
