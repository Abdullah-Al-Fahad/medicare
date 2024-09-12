@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Appointment') }}</div>

                <div class="card-body">
                    <!-- Appointment Form -->
                    <form action="{{ route('patient.appointment.store') }}" method="POST">
                        @csrf
                        <!-- <div class="form-group">
                            <label for="appointmentDate">Date</label>
                            <input type="date" class="form-control" id="appointmentDate" name="appointmentDate">
                        </div> -->
                        <div class="mb-3">
                                <label for="appointmentDate" >{{ __('Date') }}</label>
                                <input id="appointmentDate" type="date" class="form-control @error('appointmentDate') is-invalid @enderror" name="appointmentDate" value="{{ old('appointmentDate') }}" required autocomplete="appointmentDate" autofocus>

                                @error('appointmentDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
<!-- 
                        <div class="form-group">
                            <label for="appointmentTime">Time</label>
                            <input type="time" class="form-control" id="appointmentTime" name="appointmentTime">
                        </div> -->
                        <div class="mb-3">
                                <label for="appointmentTime" >{{ __('Time') }}</label>
                                <input id="appointmentTime" type="time" class="form-control @error('appointmentTime') is-invalid @enderror" name="appointmentTime" value="{{ old('appointmentTime') }}" required autocomplete="appointmentTime" >

                                @error('appointmentTime')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        <div class="form-group">
                            <label for="appointmentReason">Reason for Appointment</label>
                            <textarea class="form-control" id="appointmentReason" name="appointmentReason" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="specialization" class="form-label">{{ __('Specialization') }}</label>
                            <select id="specialization" class="form-select @error('specialization') is-invalid @enderror" name="specialization" required>
                                <option value="" selected disabled>{{ __('Select specialization') }}</option>
                                <option value="Cardiology" {{ old('specialization') === 'Cardiology' ? 'selected' : '' }}>Cardiology</option>
                                <option value="Dermatology" {{ old('specialization') === 'Dermatology' ? 'selected' : '' }}>Dermatology</option>
                                <option value="Endocrinology" {{ old('specialization') === 'Endocrinology' ? 'selected' : '' }}>Endocrinology</option>
                                <!-- Add more specialization options -->
                                <option value="Gastroenterology" {{ old('specialization') === 'Gastroenterology' ? 'selected' : '' }}>Gastroenterology</option>
                                <option value="General Practice" {{ old('specialization') === 'General Practice' ? 'selected' : '' }}>General Practice</option>
                                <option value="Hematology" {{ old('specialization') === 'Hematology' ? 'selected' : '' }}>Hematology</option>
                                <!-- Add more specialization options as needed -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="doctorName" class="form-label">{{ __('Doctor Name') }}</label>
                            <select id="doctorName" class="form-select @error('doctorName') is-invalid @enderror" name="doctorName" required>
                                <option value="" selected disabled>{{ __('Select doctor') }}</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" data-specialization="{{ $doctor->specialization }}" {{ old('doctorName') === $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Appointment Successful',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Appointment Failed',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    });
</script>

@endsection