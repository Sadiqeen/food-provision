@extends('layouts.app')

@section('title')
{{ __('Add Order') }}
@endsection

@section('content')
    <div class="container">
        <h3 class="my-3 text-uppercase font-weight-bold d-flex">
            <span class="mr-auto"><i class="fa fa-shopping-bag fa-lg mr-2" aria-hidden="true"></i> {{ __('Add Order') }}</span>
            <btn class="btn btn-danger mr-2" id="sortFromAddedItem">{{ __('Sort from added item') }}</btn>
            <a type="button" href="{{ route('admin.order.index') }}"  class="btn btn-secondary">{{ __('Manage Order') }}</a>
        </h3>
        <div class="row">
            @foreach($categories as $category)
                @php
                    $active = false;
                    if (!$selected_category && $loop->first || $category->name == $selected_category) {
                        $active = true;
                        $active_category = $category->id;
                    }
                @endphp
            @endforeach
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @include('admin.order.create-element.table')
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="list-group">
                            @foreach($categories as $category)
                                @php
                                    $active = false;
                                    if (!$selected_category && $loop->first || $category->name == $selected_category) {
                                        $active = true;
                                        $active_category = $category->id;
                                    }
                                @endphp
                                <a class="list-group-item list-group-item-action {{ $active ? 'list-group-item-info' : '' }}" href="{{ route('admin.order.create') }}?category={{ $category->name }}">
                                    {{ $category->name }}
                                    <span class="bg-white text-dark px-1 rounded float-right" id="cat-{{ $category->id }}">
                                        {{ isset(Session::get('order')[$category->id]['total']) ? number_format(Session::get('order')[$category->id]['total']) : 0 }}
                                    </span>
                                </a>
                            @endforeach
                        </div>

                        <div class="list-group mt-3">
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action list-group-item-success" tabindex="-1" aria-disabled="true">
                                <strong>{{ __('Total') }}</strong>
                                <span class="bg-white text-dark px-1 rounded float-right" id="total">
                                    {{ Session::has('total') ? number_format(Session::get('total')) : 0 }}
                                </span>
                            </a>
                        </div>

                        <div class="form-group mt-3">
                            <a href="javascript:void(0)" onclick="CancelOrder()" class="btn btn-danger">{{ __('Cancel') }}</a>
                            <a href="{{ route('admin.order.confirm') }}" class="btn btn-success float-right">{{ __('Confirm Order') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const CancelOrder = function () {
            Swal.fire({
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('All Added item will be lost') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Confirm') }}",
                cancelButtonText: "{{ __('Cancel') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    window.location.href = "{{ route('admin.order.clear') }}"
                }
            })
        }

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
