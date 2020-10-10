@extends('layouts.app')

@section('title')
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
            @if (auth()->user()->position == 'admin')
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="form-group col-md-5">
                                <label for="customer">{{ __('Customer') }} <span class="text-danger">*</span></label>
                                <select class="form-control border selectpicker" onchange="get_date_range()"
                                        data-live-search="true" data-size="10" name="customer" id="customer">
                                    <option value="All" selected>{{ __('All') }}</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="reportrange">{{ __('Duration') }} <span class="text-danger">*</span></label>
                                <div id="reportrange"
                                     style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span> <i class="fa fa-caret-down"></i>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="reportrange">{{ __('Print') }} <span class="text-danger">*</span></label>
                                <a class="form-control btn btn-success" onclick="export_excel()" href="javascript:void(0)">
                                    {{ __('Export excel') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ __('History Order') }}
                    </div>
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
                                    @if (auth()->user()->position == 'admin')
                                        <th>{{ __('Order By') }}</th>
                                    @endif
                                    <th>{{ __('Vessel Name') }}</th>
                                    <th>{{ __('Total Price') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Done on') }}</th>
                                </tr>
                                </thead>
                                <tfoot class="bg-success text-white">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Order No.') }}</th>
                                    @if (auth()->user()->position == 'admin')
                                        <th>{{ __('Order By') }}</th>
                                    @endif
                                    <th>{{ __('Vessel Name') }}</th>
                                    <th>{{ __('Total Price') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Done on') }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <link rel="stylesheet" href="{{ asset('plugins/Chart.js-2.9.3/dist/Chart.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables/datatables.css') }}"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
@endpush

@push('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="{{ asset('plugins/DataTables/datatables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/moment.js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/Chart.js-2.9.3/dist/Chart.min.js') }}"></script>
    <script>
        let table

        $(document).ready(function () {

            table = $('#dataTable').on('processing.dt', function (e, settings, processing) {
                if (processing) {
                    $('.loading').css('display', 'flex')
                } else {
                    $('.loading').css('display', 'none')
                }
            }).DataTable({
                serverSide: true,
                responsive: true,
                ajax: '{{ route( auth()->user()->position . '.report.history') }}',
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
                    @if (auth()->user()->position == 'admin')
                    {
                        data: 'customer',
                        name: 'customer'
                    },
                    @endif
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
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                ],
                @if(app()->getLocale() == "th")
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Thai.json"
                }
                @endif
            })

            @if (auth()->user()->position == 'admin')
            let start = moment('{{ $start_range->updated_at }}')
            let end = moment('{{ $end_range->updated_at }}')

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                minDate: start,
                maxDate: end,
            }, cb);

            cb(start, end);
            @endif
        })

        @if (auth()->user()->position == 'admin')
        const cb = function (start, end) {
            $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'))
            resetTable()
        }

        const export_excel = function () {
            let start = $('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD')
            let end = $('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD')
            let customer = $('#customer').val()
            window.location.href = '{{ route('admin.report.export') }}?customer=' + customer +
                        '&start_date=' + start +
                        '&end_date=' + end
        }

        const resetTable = function () {
            let start = $('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD')
            let end = $('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD')
            let customer = $('#customer').val()
            let url = '{{ route('admin.report.history') }}?customer=' + customer +
                '&start_date=' + start +
                '&end_date=' + end
            table.ajax.url(url).load()
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

        const get_date_range = function () {
            $.ajax({
                url: '{{ route('admin.report.index') }}',
                type: 'GET',
                data: {
                    customer: $('#customer').val()
                },
                success: function (data) {
                    if (data.status === "success") {
                        let start = moment(data.data.start_range)
                        let end = moment(data.data.end_range)
                        $('#reportrange').data('daterangepicker').minDate = start
                        $('#reportrange').data('daterangepicker').maxDate = end
                        $('#reportrange').data('daterangepicker').startDate = start
                        $('#reportrange').data('daterangepicker').endDate = end
                        cb(start, end)
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Something going wrong please contact developer'
                        })
                    }
                }
            });
        }
        @endif

    </script>
@endpush
