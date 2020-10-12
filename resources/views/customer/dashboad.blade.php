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
                    <h2>{{ $vessel_request ?? 0 }}</h2>

                    <p class="h4">{{ __('Request from vessel') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-bag"></i>
                </div>
                <a href="{{ route('customer.order.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-product">
                <div class="inner text-white">
                    <h2>{{ $employee ?? 0 }}</h2>

                    <p class="h4">{{ __('Employee') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('customer.employee.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-customer">
                <div class="inner text-white">
                    <h2>{{ $success ?? 0 }}</h2>

                    <p class="h4">{{ __('Success Order') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-check-circle"></i>
                </div>
                <a href="{{ route('customer.report.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-supplier">
                <div class="inner text-white">
                    <h2>{{ $cancel ?? 0 }}</h2>

                    <p class="h4">{{ __('Cancel Order') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-times-circle"></i>
                </div>
                <a href="{{ route('customer.report.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
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
