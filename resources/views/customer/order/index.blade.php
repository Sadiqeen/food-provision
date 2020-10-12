@extends('layouts.app')

@section('title')
    {{ __('Manage Order') }}
@endsection

@section('content')
    <div class="container">
        <h3 class="my-3 text-uppercase font-weight-bold d-flex">
            <span class="mr-auto"><i class="fa fa-shopping-bag fa-lg mr-2" aria-hidden="true"></i> {{ __('Manage Order') }}</span>
            <a type="button" href="{{ route( auth()->user()->position . '.order.create') }}"  class="btn btn-secondary">{{ __('Create Order') }}</a>
        </h3>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
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

    <!-- Modal -->
    <div class="modal fade" id="confirm-order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm order') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" id="confirm-order-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="po">{{ __('Purchase Order no.') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="po" name="purchase_order_number" min="3">
                        </div>
                        <div class="form-group">
                            <label class="w-100">
                                {{ __('Upload Purchase Order file') }}
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="purchase_order_file" id="purchase_order_file">
                                <label class="custom-file-label" for="customFile">{{ __('Choose file') }}</label>
                            </div>
                            @error('image')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">{{ __('Confirm order') }}</button>
                        </div>
                    </form>
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

            $("#purchase_order_file").change(function () {
                let size = this.files[0].size
                if (size > 2000000) {
                    alert('ขนาดรูปใหญ่เกินไป')
                    return false;
                }
                let poName = $(this).val().split('\\').pop()
                $(this).next('.custom-file-label').addClass("selected").text(fileName(poName))
            });

            let table = $('#dataTable').on('processing.dt', function (e, settings, processing) {
                if (processing) {
                    $('.loading').css('display', 'flex');
                } else {
                    $('.loading').css('display', 'none');
                }
            }).DataTable({
                serverSide: true,
                responsive: true,
                ajax: '{{ route( auth()->user()->position . '.order.api') }}',
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

        const confirm_order = function (url) {
            $('#confirm-order-form').attr('action', url)
            $('#confirm-order').modal('show')
        }

        function fileName(name) {
            if (name.length > 20) {
                return name.substr(0, 20) + '...'
            } else {
                return name
            }
        }
    </script>
@endpush
