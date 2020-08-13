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
                    <sale-graph :chartdata="props.chart1.data" :options="props.chart1.options" />
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">{{ __('Supplier summary') }}</h5>
                <div class="card-body">
                    <sale-graph :chartdata="props.chart2.data" :options="props.chart2.options" />
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('script')
<script>
    const chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)'
    }

    const chart1 = {
        data: {
            labels: ['1st Week', '2nd Week', '3rd Week', '4th Week', '5th Week'],
            datasets: [{
                label: '{{ __('Last month') }}',
                data: [40, 20, 23, 15, 10],
                backgroundColor: chartColors.red,
				borderColor: chartColors.red,
                fill: false
            },{
                label: '{{ __('This month') }}',
                data: [13, 25, 12, 15],
                backgroundColor: chartColors.green,
				borderColor: chartColors.green,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    }

    const chart2 = {
        data: {
            labels: ['Makro', 'BigC', 'CP', 'K\'Nah'],
            datasets: [{
                label: 'Supplier',
                backgroundColor: '#f87979',
                data: [5, 10, 15, 20, 25]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    }

    const props = {
        chart1: chart1,
        chart2: chart2,
    }

</script>
@endpush
