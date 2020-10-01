@extends('layouts.app')

@section('title')
    {{ __('Confirm Order') }}
@endsection

@section('content')
    <div class="container">
        <h3 class="my-3 text-uppercase font-weight-bold d-flex">
            <span class="mr-auto"><i class="fa fa-shopping-bag fa-lg mr-2" aria-hidden="true"></i> {{ __('Confirm Order') }}</span>
            <a type="button" href="{{ route('admin.order.create') }}"  class="btn btn-secondary">{{ __('Back') }}</a>
        </h3>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="m-0 font-weight-bold">
                                    {{ __('Total') }}
                                    <span class="float-right" id="total">{{ number_format(Session::get('total')) }}</span>
                                </h2>
                            </div>
                        </div>
                        @if (Session::has('order'))
                            @php $order = Session::get('order'); @endphp
                            @foreach($order as $category_key => $category)
                                @if (count($category['products'])  > 0)
                                <ul class="list-group mb-3">
                                    <li class="list-group-item bg-success text-white">
                                        <span class="h4 font-weight-bold">{{ $category['name'] }}</span>
                                        <span class="float-right text-dark bg-white rounded py-1 px-2"  id="cat-{{ $category_key }}">{{ number_format( $category['total'] ) }}</span>
                                    </li>
                                    @foreach($category['products'] as $product_key => $product)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if(app()->getLocale() == "th")
                                                        {{ $product['name_th'] ? $product['name_th'] : $product['name_en'] }}
                                                    @else
                                                        {{ $product['name_en'] }}
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" min="1"
                                                               data-id="{{ $product_key }}"
                                                               data-price="{{ $product['price'] }}"
                                                               onchange="updateCart(this, '{{ route('admin.order.update', $product_key) }}')"
                                                               value="{{ $product['quantity'] }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">{{ $product['unit'] }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-3 text-right">
                                                    <span id="product-{{ $product_key }}">{{ number_format($product['quantity'] * $product['price']) }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.order.save') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="unit">{{ __('Order for') }} <span class="text-danger">*</span></label>
                                        <select class="form-control border selectpicker @error('customer') is-invalid @enderror" data-live-search="true" data-size="10" name="customer" id="customer" >
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('customer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="vessel_name">{{ __('Vessel Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('vessel_name') is-invalid @enderror" name="vessel_name" id="vessel_name" value="{{ old('vessel_name') }}">
                                        @error('vessel_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group text-center">
                                       <button type="submit" class="btn btn-primary">{{ __('Confirm Order') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
@endpush

@push('script')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/i18n/defaults-*.min.js"></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        })

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        let timeout = null

        const updateCart = function (el, url) {
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                $.ajax({
                    url: url,
                    type:'POST',
                    data: {
                        quantity: $(el).val()
                    },
                    success: function(data){
                        if (data.status === "success") {
                            $.each(data.data.category, function(i, item) {
                                $('#cat-' + i).text(item)
                            })

                            let price = $(el).data('price') * $(el).val()
                            $('#product-' + $(el).data('id')).text( price.toLocaleString() )
                            $('#total').text(data.data.total)

                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Something going wrong please contact developer'
                            })
                        }
                    }
                });
            }, 500)
        }
    </script>
@endpush
