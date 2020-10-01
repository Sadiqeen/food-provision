@extends('layouts.app')

@section('title')
{{ __('Supplier') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-truck fa-lg mr-2" aria-hidden="true"></i> {{ __('Manage Supplier') }}</span>
        <a type="button" href="{{ route('admin.supplier.create') }}"  class="btn btn-secondary">{{ __('Add Supplier') }}</a>
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
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Tel') }}</th>
                            <th>{{ __('E-mail') }}</th>
                            <th>{{ __('Address') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tfoot class="bg-success text-white">
                        <tr>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Tel') }}</th>
                            <th>{{ __('E-mail') }}</th>
                            <th>{{ __('Address') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- Delete Form --}}
<form action="" method="post" class="d-none" id="delSupplier">
    @csrf
    @method('delete')
</form>
<!-- Create Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-truck fa-lg" aria-hidden="true"></i> {{ __('Add Supplier') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.supplier.store') }}" method="POST">
                    @include('admin.supplier.form')
                    <div class="form-group">
                        <a type="button" data-dismiss="modal" class="btn btn-Danger">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-success float-right">{{ __('Save') }}</button>
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
        @if ($errors->any())
            $('#create').modal('show')
        @endif

        $('#dataTable').on('processing.dt', function (e, settings, processing) {
            if (processing) {
                $('.loading').css('display', 'flex');
            } else {
                $('.loading').css('display', 'none');
            }
        }).dataTable({
            serverSide: true,
            responsive: true,
            ajax: '{{ route('admin.supplier.api') }}',
            order: [
                [0, "DESC"]
            ],
            columns: [{
                    data: 'id',
                    name: 'id',
                    visible: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'tel',
                    name: 'tel'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            @if(app()->getLocale() == "th")
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Thai.json"
                }
            @endif
        })
    })

    const delSupplier = function(url) {
        Swal.fire({
            title: "{{ __('Are you sure?') }}",
            text: "{{ __('You will not be able to revert this!') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ __('Confirm') }}",
            cancelButtonText: "{{ __('Cancel') }}",
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#delSupplier').attr('action', url).submit()
            }
        })
    }
</script>
@endpush
