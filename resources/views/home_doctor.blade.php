@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <nav class="navbar">
            <ul class="navbar-nav">
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
                        <a class="nav-link" href="{{ route('selector') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Find Out</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="background-color: white; color: black;">{{ __('Welcomne') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in as doctor!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
