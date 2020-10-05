@extends('layouts.app')

@section('title')
{{ __('View Order') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-shopping-bag fa-lg mr-2" aria-hidden="true"></i> {{ __('View Order') }}</span>
        <a type="button" href="{{ route( auth()->user()->position . '.order.index') }}"  class="btn btn-secondary">{{ __('Manage Order') }}</a>
    </h3>
    <div class="card">
        <div class="card-body">
            <div class="holder my-5">
                <ul class="SteppedProgress">
                    @foreach($order->statusDate as $status)
                        <li class="{{ $status->id > 7 ? 'cancel' : 'complete' }}">
                            <span class="h6">{{ $status->status }}</span>
                            <small class="text-muted" style="font-size: small;">{{ $status->pivot->created_at->format('d/m/Y') }}</small>
                        </li>
                    @endforeach

                    @foreach($statuses as $status)
                         <li class=""><span class="h6">{{ $status->status }}</span></li>
                    @endforeach
                </ul>
            </div>

            <div class="card bg-light mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="font-weight-bold">{{ __('Customer detail') }}</h3>
                            <hr>
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <th scope="row">{{ __('Company') }}</th>
                                    <td>{{ $order->customer->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Coordinator') }}</th>
                                    <td>{{ $order->customer->user[0]->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Tel') }}</th>
                                    <td>{{ $order->customer->tel }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('E-mail') }}</th>
                                    <td>{{ $order->customer->user[0]->email }}</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="col-md-6">
                            <h3 class="font-weight-bold">{{ __('Order detail') }}</h3>
                            <hr>
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <th scope="row">{{ __('Order number') }}</th>
                                    <td>{{ $order->order_number }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Total') }}</th>
                                    <td>{{ number_format($order->total_price) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Vessel name') }}</th>
                                    <td>{{ $order->vessel_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Make an order by') }}</th>
                                    <td>{{ $order->user->name }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered mt-4">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">{{ __('Product') }}</th>
                            <th scope="col">{{ __('Packing') }}</th>
                            <th scope="col">{{ __('Price') }}</th>
                            <th scope="col">{{ __('Quantity') }}</th>
                            <th scope="col">{{ __('Total amount') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->product as $product)
                            @php
                                if ($loop->first) {
                                    $category = $product->category->id;
                                    echo '<tr class="bg-secondary text-white"><th scope="row" colspan="5">' . $product->category->name . '</th></tr>';
                                } else {
                                    if ($category != $product->category->id) {
                                        echo '<tr class="bg-secondary text-white"><th scope="row" colspan="5">' . $product->category->name . '</th></tr>';
                                        $category = $product->category->id;
                                    }
                                }
                            @endphp
                            <tr>
                                <th scope="row">{{ $product->name }}</th>
                                <td>{{ $product->desc }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>{{ number_format($product->price * $product->pivot->quantity) }}</td>
                            </tr>
                            @if ($loop->last)
                                <tr>
                                    <th scope="row" colspan="4" class="text-center h5 font-weight-bold">{{ __('Total') }}</th>
                                    <td class="h5 font-weight-bold">{{ number_format($order->total_price) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@endpush