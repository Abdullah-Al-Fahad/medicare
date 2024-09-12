@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Doctor Settings') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('account.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', optional($user->doctor)->phone) }}" required autocomplete="phone">


                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="specialization" class="col-md-4 col-form-label text-md-right">{{ __('Specialization') }}</label>

                                <div class="col-md-6">
                                <select id="specialization" class="form-control @error('specialization') is-invalid @enderror" name="specialization" required>
    <option value="" disabled>Select specialization</option>
    <option value="Cardiology" {{ old('specialization', optional($user->doctor)->specialization) === 'Cardiology' ? 'selected' : '' }}>Cardiology</option>
    <option value="Dermatology" {{ old('specialization', optional($user->doctor)->specialization) === 'Dermatology' ? 'selected' : '' }}>Dermatology</option>
    <option value="Endocrinology" {{ old('specialization', optional($user->doctor)->specialization) === 'Endocrinology' ? 'selected' : '' }}>Endocrinology</option>
    <!-- Add more specialization options -->
    <option value="Gastroenterology" {{ old('specialization', optional($user->doctor)->specialization) === 'Gastroenterology' ? 'selected' : '' }}>Gastroenterology</option>
    <option value="General Practice" {{ old('specialization', optional($user->doctor)->specialization) === 'General Practice' ? 'selected' : '' }}>General Practice</option>
    <option value="Hematology" {{ old('specialization', optional($user->doctor)->specialization) === 'Hematology' ? 'selected' : '' }}>Hematology</option>
    <!-- Add more specialization options as needed -->
</select>


                                    @error('specialization')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="hospital" class="col-md-4 col-form-label text-md-right">{{ __('Hospital') }}</label>

                                <div class="col-md-6">
                                <input id="hospital" type="text" class="form-control @error('hospital') is-invalid @enderror" name="hospital" value="{{ old('hospital', optional($user->doctor)->hospital) }}" required autocomplete="hospital">

                                    @error('hospital')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="room" class="col-md-4 col-form-label text-md-right">{{ __('Room Number') }}</label>

                                <div class="col-md-6">
                                       <input id="room" type="text" class="form-control @error('room') is-invalid @enderror" name="room" value="{{ old('room', optional($user->doctor)->room) }}" required autocomplete="room">

                                    @error('room')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
