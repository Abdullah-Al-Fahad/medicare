@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Graph Input Form</h2>

        <form action="{{ route('graphs.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <h3>Weight Increase</h3>
                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="number" step="0.1" class="form-control" name="weight" id="weight" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Oxygen Level</h3>
                    <div class="form-group">
                        <label for="oxygen">Oxygen Level</label>
                        <input type="number" step="0.1" class="form-control" name="oxygen" id="oxygen" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h3>Sugar Level</h3>
                    <div class="form-group">
                        <label for="sugar">Sugar Level</label>
                        <input type="number" step="0.1" class="form-control" name="sugar" id="sugar" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Sleep Cycle</h3>
                    <div class="form-group">
                        <label for="sleep">Sleep Cycle</label>
                        <input type="number" step="0.1" class="form-control" name="sleep" id="sleep" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
