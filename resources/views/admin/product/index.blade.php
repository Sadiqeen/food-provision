@extends('layouts.app')

@section('title')
{{ __('Supplier') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-archive fa-lg mr-2"></i> {{ __('Manage Product') }}</span>
        <a type="button" href="{{ route('admin.product.create') }}"  class="btn btn-secondary">{{ __('Add Product') }}</a>
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
                            <th>{{ __('Product') }}</th>
                            <th>{{ __('Brand') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tfoot class="bg-success text-white">
                        <tr>
                            <th>#</th>
                            <th>{{ __('Product') }}</th>
                            <th>{{ __('Brand') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Price') }}</th>
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

<!-- View Modal -->
<div class="modal fade" id="view" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-archive fa-lg mr-2"></i> {{ __('View Product') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('English') }}</th>
                                <th scope="col">{{ __('Thai') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <strong>{{ __('Product') }}</strong>
                                </th>
                                <td>Oranges Sunkist</td>
                                <td>ส้มซันคิสท์</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Price') }}</th>
                                <td colspan="2">800</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Descrip') }}</th>
                                <td>Oranges Sunkist</td>
                                <td>ส้มซันคิสท์</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Unit') }}</th>
                                <td>Case</td>
                                <td>กล่อง</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Category') }}</th>
                                <td>Case</td>
                                <td>กล่อง</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Brand') }}</th>
                                <td>Case</td>
                                <td>กล่อง</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Supplier') }}</th>
                                <td>Case</td>
                                <td>กล่อง</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
            ajax: '{{ route('admin.product.api') }}',
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
                    data: 'brand',
                    name: 'brand'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
            @if(app()->getLocale() == "th")
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Thai.json"
                }
            @endif
        })
    })

    const viewProduct = function(url) {
        $( "#view" ).modal( "show" )
    }

    const delSupplier = function(url) {
        Swal.fire({
            title: "{{ __('Are you sure?') }}",
            text: "{{ __('You won\'t be able to revert this!') }}",
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
