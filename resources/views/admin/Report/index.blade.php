@extends('layouts.app')

@section(' title')
    {{ __('Report') }}
@endsection

@section('content')
    <div class="container">
        <h3 class="my-3 text-uppercase font-weight-bold d-flex">
            <span class="mr-auto"><i class="fa fa-file-text fa-lg mr-2"></i> {{ __('Report') }}</span>
            <a type="button" href="{{ route('dashboard') }}"
               class="btn btn-secondary">{{ __('Dashboard') }}</a>
        </h3>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ __('Sale result') }}
                    </div>
                    <div class="card-body">
                        {!! $sale_result_average->render() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ __('Sale result') }}
                    </div>
                    <div class="card-body">
                        {!! $most_spendors->render() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ __('History Order') }}
                    </div>
                    <div class="card-body">
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
                                <th>{{ __('Order By') }}</th>
                                <th>{{ __('Vessel Name') }}</th>
                                <th>{{ __('Total Price') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                            </thead>
                            <tfoot class="bg-success text-white">
                            <tr>
                                <th>#</th>
                                <th>{{ __('Order No.') }}</th>
                                <th>{{ __('Order By') }}</th>
                                <th>{{ __('Vessel Name') }}</th>
                                <th>{{ __('Total Price') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('plugins/Chart.js-2.9.3/dist/Chart.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables/datatables.css') }}" />
@endpush

@push('script')
    <script type="text/javascript" src="{{ asset('plugins/DataTables/datatables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/moment.js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/Chart.js-2.9.3/dist/Chart.min.js') }}"></script>
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
                ajax: '{{ route('admin.report.history') }}',
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
                        data: 'customer',
                        name: 'customer'
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
                ],
                @if(app()->getLocale() == "th")
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Thai.json"
                }
                @endif
            })
        })
    </script>
@endpush
