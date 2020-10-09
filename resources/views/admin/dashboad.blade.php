@extends('layouts.app')

@section('title')
{{ __('Dashboard') }}
@endsection

@section('content')
<div class="container">

    <div class="row">

        <div class="col-lg-3 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-order">
                <div class="inner text-white">
                    <h2>{{ $order }}</h2>

                    <p class="h4">{{ __('New Order') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-bag"></i>
                </div>
                <a href="{{ route('admin.order.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-product">
                <div class="inner text-white">
                    <h2>{{ $product ?? 0 }}</h2>

                    <p class="h4">{{ __('Product') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-envelope-o"></i>
                </div>
                <a href="{{ route('admin.product.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-customer">
                <div class="inner text-white">
                    <h2>{{ $customer ?? 0 }}</h2>

                    <p class="h4">{{ __('Customer') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('admin.customer.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-supplier">
                <div class="inner text-white">
                    <h2>{{ $supplier ?? 0 }}</h2>

                    <p class="h4">{{ __('Supplier') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-truck"></i>
                </div>
                <a href="{{ route('admin.supplier.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>

    </div>
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
<style>
    .bg-order {
        background-color: #00a797;
    }

    .bg-supplier {
        background-color: #dc3545;
    }

    .bg-customer {
        background-color: #41a745;
    }

    .bg-product {
        background-color: #45a3b7;
    }

    .small-box {
        border-radius: .25rem;
        box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        display: block;
        margin-bottom: 20px;
        position: relative;
    }

    .small-box>.inner {
        padding: 15px;
    }

    .small-box .icon {
        color: rgba(0,0,0,.15);
        z-index: 0;
    }

    .small-box>.small-box-footer {
        background: rgba(0,0,0,.1);
        color: rgba(255,255,255,.8);
        display: block;
        padding: 3px 0;
        position: relative;
        text-align: center;
        text-decoration: none;
        z-index: 10;
    }

    .small-box .icon>i {
        font-size: 60px;
        position: absolute;
        right: 15px;
        top: 15px;
        transition: all .3s linear;
    }

</style>
@endpush

@push('script')
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
