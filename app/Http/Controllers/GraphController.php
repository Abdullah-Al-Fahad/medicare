<?php

namespace App\Http\Controllers;

use App\Models\Graph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller
{    
    public function create()
    {
        return view('graphs.create');
    }

    public function show()
    {
        return view('graphs.show');
    }

    public function showx()
    {
        return view('graphs.shon');
    }


    public function showGraphs()
 {  

 $user = Auth::user();
 $graphs = Graph::where('user_id', $user->user_id)->get();

    $weight = [
        'labels' => $graphs->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d');
        }),
        'data' => $graphs->pluck('weight'),
    ];

    $oxygen = [
        'labels' => $graphs->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d');
        }),
        'data' => $graphs->pluck('oxygen'),
    ];

    $sugar = [
        'labels' => $graphs->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d');
        }),
        'data' => $graphs->pluck('sugar'),
    ];

    $sleep = [
        'labels' => $graphs->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d');
        }),
        'data' => $graphs->pluck('sleep'),
    ];

    $data = compact('weight', 'oxygen', 'sugar', 'sleep');
    return response()->json($data);
}


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'weight' => 'required|numeric',
            'oxygen' => 'required|numeric',
            'sugar' => 'required|numeric',
            'sleep' => 'required|numeric',
        ]);

        $validatedData['user_id'] = Auth::id();

        Graph::create($validatedData);

        return redirect()->route('graphs.create')->with('success', 'Graph data submitted successfully!');


    }
    public function getData()
            {
                $graphs = Graph::where('user_id', Auth::id())->get();

                $weight = [
                    'labels' => $graphs->pluck('created_at')->map(function ($date) {
                        return $date->format('Y-m-d');
                    }),
                    'data' => $graphs->pluck('weight'),
                ];

                $oxygen = [
                    'labels' => $graphs->pluck('created_at')->map(function ($date) {
                        return $date->format('Y-m-d');
                    }),
                    'data' => $graphs->pluck('oxygen'),
                ];

                $sugar = [
                    'labels' => $graphs->pluck('created_at')->map(function ($date) {
                        return $date->format('Y-m-d');
                    }),
                    'data' => $graphs->pluck('sugar'),
                ];

                $sleep = [
                    'labels' => $graphs->pluck('created_at')->map(function ($date) {
                        return $date->format('Y-m-d');
                    }),
                    'data' => $graphs->pluck('sleep'),
                ];

                $data = compact('weight', 'oxygen', 'sugar', 'sleep');

                return response()->json($data);
            }



public function patientselector()

  { 
    $user = Auth::user();

    $appointments = Appointment::join('users', 'appointments.patient_id', '=', 'users.id')
        ->join(DB::raw('(SELECT MIN(id) as id, patient_id FROM appointments GROUP BY patient_id) as sub'), function ($join) {
            $join->on('appointments.id', '=', 'sub.id');
            $join->on('appointments.patient_id', '=', 'sub.patient_id');
        })
        ->where('appointments.doctor_id', $user->user_id)
        ->select('appointments.*', 'users.name as patient_name')
        ->get();
    
    return view('patientgraph', compact('appointments'));

   }

}