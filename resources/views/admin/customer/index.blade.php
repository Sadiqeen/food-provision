@extends('layouts.app')

@section('title')
{{ __('Customer') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-user fa-lg mr-2" aria-hidden="true"></i> {{ __('Manage Customer') }}</span>
        <a type="button" href="{{ route('admin.customer.create') }}"  class="btn btn-secondary">{{ __('Add Customer') }}</a>
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
                            <th>{{ __('Customer') }}</th>
                            <th>{{ __('Coordinator') }}</th>
                            <th>{{ __('Tel') }}</th>
                            <th>{{ __('E-mail') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tfoot class="bg-success text-white">
                        <tr>
                            <th>#</th>
                            <th>{{ __('Customer') }}</th>
                            <th>{{ __('Coordinator') }}</th>
                            <th>{{ __('Tel') }}</th>
                            <th>{{ __('E-mail') }}</th>
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
                <h5 class="modal-title"><i class="fa fa-archive fa-lg mr-2"></i> {{ __('View Customer') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row my-5 py-5" id="view-customer-loading">
                    <div class="m-auto">
                        <div class="spinner-grow text-danger" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="table-responsive d-none" id="view-customer-data">
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
                                    <strong>{{ __('customer') }}</strong>
                                </th>
                                <td><span id="name_en"></span></td>
                                <td><span id="name_th"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Price') }}</th>
                                <td colspan="2"><span id="price"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Describe') }}</th>
                                <td><span id="desc_en"></span></td>
                                <td><span id="desc_th"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Unit') }}</th>
                                <td><span id="unit_en"></span></td>
                                <td><span id="unit_th"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Category') }}</th>
                                <td><span id="category_en"></span></td>
                                <td><span id="category_th"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Brand') }}</th>
                                <td><span id="brand_en"></span></td>
                                <td><span id="brand_th"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Supplier') }}</th>
                                <td><span id="supplier_en"></span></td>
                                <td><span id="supplier_th"></span></td>
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
            ajax: '{{ route('admin.customer.api') }}',
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
                    data: 'coordinator',
                    name: 'coordinator'
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

        $('#view').on('hidden.bs.modal', function (e) {
            $( '#view-customer-loading' ).removeClass( 'd-none' )
            $( '#view-customer-data' ).addClass( 'd-none' )
        })
    })

    const viewCustomer = function(url) {
        $( "#view" ).modal( "show" )
        $.get(url , function(data, status){
            let res = data.data
            console.log(res)
            $( '#price' ).text( res.price )
            $( '#name_en' ).text( res.name_en )
            $( '#name_th' ).text( res.name_th )
            $( '#desc_en' ).text( res.desc_en )
            $( '#desc_th' ).text( res.desc_th )
            $( '#unit_en' ).text( res.unit.name_en )
            $( '#unit_th' ).text( res.unit.name_th )
            $( '#category_en' ).text( res.category.name_en )
            $( '#category_th' ).text( res.category.name_th )
            $( '#brand_en' ).text( res.brand.name_en )
            $( '#brand_th' ).text( res.brand.name_th )
            $( '#supplier_en' ).text( res.supplier.name_en )
            $( '#supplier_th' ).text( res.supplier.name_th )

            $( '#view-customer-loading' ).addClass( 'd-none' )
            $( '#view-customer-data' ).removeClass( 'd-none' )
        });
    }

    const delCustomer = function(url) {
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
