@extends('layouts.app')

@section('title')
    {{ __('Manage Order') }}
@endsection

@section('content')
    <div class="container">
        <h3 class="my-3 text-uppercase font-weight-bold d-flex">
            <span class="mr-auto"><i class="fa fa-shopping-bag fa-lg mr-2" aria-hidden="true"></i> {{ __('Manage Order') }}</span>
            <a type="button" href="{{ route('customer.order.create') }}"  class="btn btn-secondary">{{ __('Add Order') }}</a>
        </h3>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive-lg position-relative">
                    <div class="loading">
                        <div class="spinner-grow text-danger" style="width: 5rem; height: 5rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <table class="table table-striped position-relative" id="dataTable">
                        <thead class="bg-success text-white">
                            <tr>
                                <th>#</th>
                                <th>{{ __('Order No.') }}</th>
                                <th>{{ __('Vessel Name') }}</th>
                                <th>{{ __('Total Price') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tfoot class="bg-success text-white">
                            <tr>
                                <th>#</th>
                                <th>{{ __('Order No.') }}</th>
                                <th>{{ __('Vessel Name') }}</th>
                                <th>{{ __('Total Price') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables/datatables.css') }}" />
@endpush

@push('script')
    <script type="text/javascript" src="{{ asset('plugins/DataTables/datatables.js') }}"></script>
    <script>
        $(document).ready(function () {

            let table = $('#dataTable').on('processing.dt', function (e, settings, processing) {
                if (processing) {
                    $('.loading').css('display', 'flex');
                } else {
                    $('.loading').css('display', 'none');
                }
            }).DataTable({
                serverSide: true,
                responsive: true,
                ajax: '{{ route('customer.order.api') }}',
                order: [
                    [0, "DESC"]
                ],
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        visible: false,
                        searchable: false
                    },
                    {
                        data: 'order_number',
                        name: 'order_number'
                    },
                    {
                        data: 'vessel_name',
                        name: 'vessel_name'
                    },
                    {
                        data: 'total_price',
                        name: 'total_price'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                @if(app()->getLocale() == "th")
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Thai.json"
                }
                @endif
            })

            const urlParams = new URLSearchParams(window.location.search)
            if (urlParams.has('query')) {
                table.search( urlParams.get('query') ).draw();
            }

        })
    </script>
@endpush
