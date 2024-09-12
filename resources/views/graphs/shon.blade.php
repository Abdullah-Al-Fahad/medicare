<!-- graphs/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
       

        <div class="row">
            <div class="col-md-6">
                <h3>Weight Increase</h3>
                <div style="height: 300px;">
                    <canvas id="weightChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Oxygen Level</h3>
                <div style="height: 300px;">
                    <canvas id="oxygenChart"></canvas>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h3>Sugar Level</h3>
                <div style="height: 300px;">
                    <canvas id="sugarChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Sleep Cycle</h3>
                <div style="height: 300px;">
                    <canvas id="sleepChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Retrieve data from the server
            fetch("{{ route('enx') }}")
                .then(response => response.json())
                .then(data => {
                    // Weight Increase Chart
                    var weightChartCanvas = document.getElementById('weightChart');
                    var weightChart = new Chart(weightChartCanvas, {
                        type: 'line',
                        data: {
                            labels: data.weight.labels,
                            datasets: [{
                                label: 'Weight',
                                data: data.weight.data,
                                borderColor: 'blue',
                                fill: false
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });

                    // Oxygen Level Chart
                    var oxygenChartCanvas = document.getElementById('oxygenChart');
                    var oxygenChart = new Chart(oxygenChartCanvas, {
                        type: 'line',
                        data: {
                            labels: data.oxygen.labels,
                            datasets: [{
                                label: 'Oxygen Level',
                                data: data.oxygen.data,
                                borderColor: 'green',
                                fill: false
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });

                    // Sugar Level Chart
                    var sugarChartCanvas = document.getElementById('sugarChart');
                    var sugarChart = new Chart(sugarChartCanvas, {
                        type: 'line',
                        data: {
                            labels: data.sugar.labels,
                            datasets: [{
                                label: 'Sugar Level',
                                data: data.sugar.data,
                                borderColor: 'red',
                                fill: false
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });

                    // Sleep Cycle Chart
                    var sleepChartCanvas = document.getElementById('sleepChart');
                    var sleepChart = new Chart(sleepChartCanvas, {
                        type: 'bar',
                        data: {
                            labels: data.sleep.labels,
                            datasets: [{
                                label: 'Sleep Cycle',
                                data: data.sleep.data,
                                backgroundColor: 'purple'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        });
    </script>
@endsection
