@extends('layouts.app')

@section('title')
{{ __('Dashboard') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">{{ __('Sales summary') }}</h5>
                <div class="card-body">
                    <canvas id="chart1" width="400" height="300"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">{{ __('Supplier summary') }}</h5>
                <div class="card-body">
                    <canvas id="chart2" width="400" height="300"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('plugins/Chart.js-2.9.3/dist/Chart.min.css') }}">
@endpush

@push('script')
<script type="text/javascript" src="{{ asset('plugins/moment.js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/Chart.js-2.9.3/dist/Chart.min.js') }}"></script>
<script>
    var chart1 = document.getElementById('chart1');
    var myChart1 = new Chart(chart1, {
        type: 'line',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                fill: false,
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgb(153, 102, 255)',
                borderColor: 'rgb(153, 102, 255)',
            }, {
                label: '# of Votes',
                fill: false,
                data: [4, 2, 13, 11, 25, 30],
                backgroundColor: 'rgba(255, 159, 64, 1)',
                borderColor: 'rgba(255, 159, 64, 1)',
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    var chart2 = document.getElementById('chart2');
    var myChart2 = new Chart(chart2, {
        type: 'line',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                fill: false,
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgb(54, 162, 235)',
                borderColor: 'rgb(54, 162, 235)',
            }, {
                label: '# of Votes',
                fill: false,
                data: [4, 2, 13, 11, 25, 30],
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@endpush