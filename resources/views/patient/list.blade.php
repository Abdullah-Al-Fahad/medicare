@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

    
        <div class="col-md-2">
        <div class="col-md-2">
            <nav class="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.appointment') }}">Appointment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.appointmentslist') }}">List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('forum.index') }}">Forum</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chat.index') }}">Communication</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('graphs.show') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Find Out</a>
                    </li>
                </ul>
            </nav>
        </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Appointment List') }}</div>

                <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Reason</th>
                                <th>Specialization</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ $appointment->time }}</td>
                                    <td>{{ $appointment->reason }}</td>
                                    <td>{{ $appointment->specialization }}</td>
                                    <td>
                                        <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this appointment?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No appointments available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
