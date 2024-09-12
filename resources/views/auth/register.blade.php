@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <div class="form-toggle mb-3">
                            <input type="radio" id="patient-radio" name="formToggle" value="patient" checked>
                            <label for="patient-radio" class="me-2">Patient</label>
                            <input type="radio" id="doctor-radio" name="formToggle" value="doctor">
                            <label for="doctor-radio">Doctor</label>
                        </div>

                        <form id="patient" method="POST" action="{{ route('patient.register.submit') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="location" class="form-label">{{ __('Location') }}</label>
                                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location">

                                @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="dob" class="form-label">{{ __('Date of Birth') }}</label>
                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob">

                                @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="sex" class="form-label">{{ __('Sex') }}</label>
                                <select id="sex" class="form-select @error('sex') is-invalid @enderror" name="sex" required>
                                    <option value="">Select Sex</option>
                                    <option value="male" {{ old('sex') === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('sex') === 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('sex') === 'other' ? 'selected' : '' }}>Other</option>
                                </select>

                                @error('sex')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="d-grid">
                            <button type="submit" class="btn btn-primary" onclick="registerForm(this.form)">{{ __('Register') }}</button>
                            </div>
                        </form>

                        <form id="doctor" style="display: none;" method="POST" action="{{ route('doctor.register.submit') }}">
                            @csrf
                            <div class="mb-3">
                                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                          <div class="mb-3">
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

                                            @error('specialization')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                                <label for="hospital" class="form-label">{{ __('Hospital') }}</label>
                                                <input id="hospital" type="text" class="form-control @error('hospital') is-invalid @enderror" name="hospital" value="{{ old('hospital') }}" required autocomplete="hospital">

                                                @error('hospital')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="room" class="form-label">{{ __('Room Number') }}</label>
                                                <input id="room" type="text" class="form-control @error('room') is-invalid @enderror" name="room" value="{{ old('room') }}" required autocomplete="room">

                                                @error('room')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                             
                                            <div class="mb-3">
                                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>     
                                            
                                            <div class="d-grid">
                                            <button type="submit" class="btn btn-primary" onclick="registerForm(this.form)">{{ __('Register') }}</button>
                            </div>
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
    // Get the form elements and radio buttons
    const patient = document.getElementById('patient');
    const doctor = document.getElementById('doctor');
    const radiopatient = document.getElementById('patient-radio');
    const radiodoctor = document.getElementById('doctor-radio');

    // Add event listeners to radio buttons for form toggling
    radiopatient.addEventListener('change', () => {
        patient.style.display = 'block';
        doctor.style.display = 'none';
    });

    radiodoctor.addEventListener('change', () => {
        patient.style.display = 'none';
        doctor.style.display = 'block';
    });

    // Add event listener to register button for form submission
    function registerForm(form) {
    //  Perform form submission using AJAX
        $.ajax({
            type: form.method,
            url: form.action,
            data: $(form).serialize(),
            success: function (response) {
                // Handle success response
                Swal.fire({
                    icon: 'success',
                    title: 'Registration Successful',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 4000
                });
            },
            error: function (error) {
                // Handle error response
                Swal.fire({
                    icon: 'error',
                    title: 'Registration Failed',
                    text: error.responseJSON.message,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    }
    </script>
@endsection
