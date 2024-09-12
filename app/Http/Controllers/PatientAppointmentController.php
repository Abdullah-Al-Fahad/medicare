<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class PatientAppointmentController extends Controller
{
    public function index()
    {
        // Fetch all doctors from the database
        $doctors = Doctor::all();

        return view('patient.p_appointment', compact('doctors'));
    }
    
    public function store(Request $request)
    {
        // $request->validate([
        //     'appointmentDate' => 'required|date',
        //     'appointmentTime' => 'required',
        //     'appointmentReason' => 'required',
        //     'specialization' => 'required',
        //     'doctorName' => 'required',
        // ]);
        $request->validate([
            'appointmentDate' => [
                'required',
                'date',
                'after_or_equal:today', // Ensure the appointment date is today or a future date
                function ($attribute, $value, $fail) {
                    $selectedDate = Carbon::parse($value);
                    $dayOfWeek = $selectedDate->dayOfWeek;
    
                    // Check if selected date is Friday or Saturday
                    if ($dayOfWeek === Carbon::FRIDAY || $dayOfWeek === Carbon::SATURDAY) {
                        $fail('Appointment date cannot be on a Friday or Saturday.');
                    }
                },
            ],
            // 'appointmentTime' => [
            //     'required',
            //     function ($attribute, $value, $fail) {
            //         $selectedTime = Carbon::parse($value);
    
            //         // Check if selected time is between 8 PM and 8:59 AM
            //         if ($selectedTime->format('H:i') >= '20:00' || $selectedTime->format('H:i') < '09:00') {
            //             $fail('Appointment time cannot be between 8 PM and 8:59 AM.');
            //         }
            //     },
            // ],
            // 'appointmentTime' => [
            //     'required',
            //     function ($attribute, $value, $fail) use ($request) {
            //         $selectedTime = Carbon::parse($value);
            //         $doctor_id = $request->input('doctorName');
    
            //         // Check if selected time is between 8 PM and 8:59 AM
            //         if ($selectedTime->format('H:i') >= '20:00' || $selectedTime->format('H:i') < '09:00') {
            //             $fail('Appointment time cannot be between 8 PM and 8:59 AM.');
            //         }
    
            //         // Check for conflicts with other appointments
            //         $appointmentDate = Carbon::parse($request->input('appointmentDate'));
    
            //         $existingAppointments = Appointment::where('doctor_id', $doctor_id)
            //             ->whereDate('date', $appointmentDate)
            //             ->whereTime('time', '>=', $selectedTime->subMinutes(15))
            //             ->whereTime('time', '<=', $selectedTime->addMinutes(15))
            //             ->count();
    
            //         if ($existingAppointments > 0) {
            //             $fail('There is a conflict with another appointment for the same doctor.');
            //         }
            //     },
            // ],
            'appointmentTime' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $selectedTime = Carbon::parse($value);
                    $selectedDoctor = $request->input('doctorName');
    
                    // Check if selected time is between 8 PM and 8:59 AM
                    if ($selectedTime->format('H:i') >= '20:00' || $selectedTime->format('H:i') < '09:00') {
                        $fail('Appointment time cannot be between 8 PM and 8:59 AM.');
                    }
    
                    $previousAppointmentTime = $selectedTime->copy()->subMinutes(15)->format('H:i:s');
                    $nextAppointmentTime = $selectedTime->copy()->addMinutes(15)->format('H:i:s');
    
                    $conflictingAppointment = Appointment::where('doctor_id', $selectedDoctor)
                        ->where('Date', $request->input('appointmentDate'))
                        ->where(function ($query) use ($previousAppointmentTime, $nextAppointmentTime) {
                            $query->where(function ($query) use ($previousAppointmentTime, $nextAppointmentTime) {
                                $query->where('Time', '>=', $previousAppointmentTime)
                                    ->where('Time', '<=', $nextAppointmentTime);
                            })->orWhere(function ($query) use ($previousAppointmentTime, $nextAppointmentTime) {
                                $query->where('Time', '>', $previousAppointmentTime)
                                    ->where('Time', '<', $nextAppointmentTime);
                            });
                        })
                        ->exists();
    
                    if ($conflictingAppointment) {
                        $fail('Appointment time conflicts with another appointment for the same doctor.');
                    }
                },
            ],
            'appointmentReason' => 'required',
            'specialization' => 'required',
            'doctorName' => 'required',
            // 'patient_id' => [
            //     'required',
            //     Rule::unique('appointments')->where(function ($query) use ($request) {
            //         return $query->where('appointmentDate', $request->input('appointmentDate'))
            //             ->where('appointmentTime', $request->input('appointmentTime'));
            //     }),
            // ],
            // Add more validation rules as needed
        ]);

        // Get the authenticated patient
        $patient = Auth::user();

        // Find the selected doctor
        $doctor = Doctor::find($request->input('doctorName'));

        if ($doctor) {
            // Create the appointment
            Appointment::create([
                'patient_id' => $patient->user_id,
                'doctor_id' => $doctor->id,
                'date' => $request->input('appointmentDate'),
                'time' => $request->input('appointmentTime'),
                'reason' => $request->input('appointmentReason'),
                'specialization' => $request->input('specialization'),
            ]);

            return redirect()->back()->with('success', 'Appointment created successfully!');
        }

        return redirect()->back()->with('error', 'Selected doctor not found.');
    }
}
