@extends('layouts.app')

@section('title')
    {{ __('View Order') }}
@endsection

@section('content')
    <div class="container">
        <h3 class="my-3 text-uppercase font-weight-bold d-flex">
            <span class="mr-auto"><i class="fa fa-shopping-bag fa-lg mr-2" aria-hidden="true"></i> {{ __('View Order') }}</span>
            @if ($order->status_id >= 8)
                <div class="dropdown mr-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Print
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach($order->statusDate as $status)
                            @php
                                if ($status->id == 2 || $status->id == 3 && auth()->user()->position != 'employee') {
                                    echo '<a class="dropdown-item" target="_blank" href="' . route(auth()->user()->position . '.order.call', [$order->id, 'quote']) . '">Quote</a>';
                                }

                                if ($status->id == 4 && $order->purchase_order_file) {
                                    echo '<a class="dropdown-item" target="_blank" href="' . route(auth()->user()->position . '.order.call', [$order->id, 'po']) . '">Purchase Order</a>';
                                }

                                if ($status->id == 5 && auth()->user()->position == 'admin') {
                                    echo '<a class="dropdown-item" target="_blank" href="' . route(auth()->user()->position . '.order.call', [$order->id, 'supply']) . '">Order supplier list</a>';
                                }

                                if ($status->id == 6 && auth()->user()->position == 'admin') {
                                    echo '<a class="dropdown-item" target="_blank" href="' . route(auth()->user()->position . '.order.call', [$order->id, 'do']) . '">Delivery Order</a>';
                                }

                                if ($status->id == 7 && auth()->user()->position != 'employee') {
                                    echo '<a class="dropdown-item" target="_blank" href="' . route(auth()->user()->position . '.order.call', [$order->id, 'invoice']) . '">Invoice</a>';
                                }
                            @endphp
                        @endforeach
                    </div>
                </div>
            @endif
            @if ($order->status_id >= 8)
                <a type="button" href="{{ route(auth()->user()->position . '.report.index') }}"
                   class="btn btn-secondary">{{ __('Order History') }}</a>
            @else
                <a type="button" href="{{ route( auth()->user()->position . '.order.index') }}"
                   class="btn btn-secondary">{{ __('Manage Order') }}</a>
            @endif
        </h3>
        <div class="card">
            <div class="card-body">
                <div class="holder my-5">
                    <ul class="SteppedProgress">
                        @foreach($order->statusDate as $status)
                            <li class="{{ $status->id > 8 ? 'cancel' : 'complete' }}">
                                <span class="h6">{{ $status->id == 2 ? __('Request Quote') : $status->status }}</span>
                                <small class="text-muted"
                                       style="font-size: small;">{{ $status->pivot->created_at->format('d/m/Y') }}</small>
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
                                        <td>
                                            {{ (int) $order->total_price == $order->total_price
                                                ? number_format($order->total_price)
                                                : number_format($order->total_price, 2) }}
                                        </td>
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
                            <th scope="col" class="text-center">{{ __('Packing') }}</th>
                            <th scope="col" class="text-center">{{ __('Price') }}/{{__('Unit') }}</th>
                            <th scope="col" class="text-center">{{ __('Quantity') }}</th>
                            <th scope="col" class="text-center">{{ __('Subtotal') }}</th>
                            <th scope="col" class="text-center">{{ __('VAT 7 %') }}</th>
                            <th scope="col" class="text-center">{{ __('Total amount') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->product as $product)
                            @php
                                if ($loop->first) {
                                    $category = $product->category->id;
                                    echo '<tr class="bg-secondary text-white"><th scope="row" colspan="7">' . $product->category->name . '</th></tr>';
                                } else {
                                    if ($category != $product->category->id) {
                                        echo '<tr class="bg-secondary text-white"><th scope="row" colspan="7">' . $product->category->name . '</th></tr>';
                                        $category = $product->category->id;
                                    }
                                }

                                $vat = 0;
                            @endphp
                            <tr>
                                <th scope="row" id="p-{{ $product->id }}-name">{{ $product->name }}</th>
                                <td class="text-center" id="p-{{ $product->id }}-desc">{{ $product->desc }}</td>
                                <td class="text-center">
                                    <span id="p-{{ $product->id }}-price"
                                          data-main="{{ $product->price }}">
                                        {{ (int) $product->calculate->price == $product->calculate->price
                                            ? number_format($product->calculate->price)
                                            : number_format($product->calculate->price, 2)}}
                                    </span>
                                </td>
                                <td class="text-center" id="p-{{ $product->id }}-quantity">
                                    {{ (int) $product->calculate->quantity == $product->calculate->quantity
                                            ? number_format($product->calculate->quantity)
                                            : number_format($product->calculate->quantity, 2)}}
                                </td>
                                <td class="text-center" id="p-{{ $product->id }}-subtotal">
                                    {{ (int) $product->calculate->sub_total == $product->calculate->sub_total
                                            ? number_format($product->calculate->sub_total)
                                            : number_format($product->calculate->sub_total, 2)}}
                                </td>
                                <td class="text-center" id="p-{{ $product->id }}-vat">
                                    {{ (int) $product->calculate->vat == $product->calculate->vat
                                            ? number_format($product->calculate->vat)
                                            : number_format($product->calculate->vat, 2)}}
                                </td>
                                <td class="text-center" id="p-{{ $product->id }}-total">
                                    {{ number_format($product->calculate->total_amount, 2)}}
                                </td>
                            </tr>
                            @if ($loop->last)
                                @if ($order->discount)
                                <tr>
                                    <td scope="row" colspan="6"
                                        class="text-center">{{ __('Subtotal') }} (THB)
                                    </td>
                                    <td class="text-center font-weight-bold" id="discount">{{ number_format($order->total_price + $order->discount , 2)}}</td>
                                </tr>
                                <tr>
                                    <td scope="row" colspan="6"
                                        class="text-center text-danger">{{ __('Discount') }} (THB)
                                    </td>
                                    <td class="text-center text-danger" id="discount">{{ number_format($order->discount, 2) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th scope="row" colspan="6"
                                        class="text-center h5 font-weight-bold">{{ __('Total amount') }} (THB)
                                    </th>
                                    <td class="h5 font-weight-bold text-center">{{ number_format($order->total_price, 2) }}</td>
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
