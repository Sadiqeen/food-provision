@extends('layouts.app')

@section('title')
{{ __('Product') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-archive fa-lg mr-2"></i> {{ __('Manage Product') }}</span>
        {{--<a type="button" href="{{ route('admin.product.upload') }}"  class="btn btn-success mr-2">{{ __('Import') }}</a>--}}
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
                            <th>{{ __('Product') }} TH</th>
                            <th>{{ __('Brand') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Unit') }}</th>
                            <th>{{ __('Supplier') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tfoot class="bg-success text-white">
                        <tr>
                            <th>#</th>
                            <th>{{ __('Product') }}</th>
                            <th>{{ __('Product') }} TH</th>
                            <th>{{ __('Brand') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Unit') }}</th>
                            <th>{{ __('Supplier') }}</th>
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
                <div class="row my-5 py-5" id="view-product-loading">
                    <div class="m-auto">
                        <div class="spinner-grow text-danger" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="table-responsive d-none" id="view-product-data">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center" style="width: 35%">{{ __('English') }}</th>
                                <th scope="col" class="text-center" style="width: 35%">{{ __('Thai') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <strong>{{ __('Product') }}</strong>
                                </th>
                                <td class="text-center"><span id="name_en"></span></td>
                                <td class="text-center"><span id="name_th"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Price') }}</th>
                                <td colspan="2" class="text-center"><span id="price"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Describe') }}</th>
                                <td class="text-center"><span id="desc_en"></span></td>
                                <td class="text-center"><span id="desc_th"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Unit') }}</th>
                                <td class="text-center"><span id="unit_en"></span></td>
                                <td class="text-center"><span id="unit_th"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Category') }}</th>
                                <td class="text-center"><span id="category_en"></span></td>
                                <td class="text-center"><span id="category_th"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Brand') }}</th>
                                <td class="text-center"><span id="brand_en"></span></td>
                                <td class="text-center"><span id="brand_th"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Supplier') }}</th>
                                <td class="text-center"><span id="supplier_en"></span></td>
                                <td class="text-center"><span id="supplier_th"></span></td>
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

        let table = $('#dataTable').on('processing.dt', function (e, settings, processing) {
            if (processing) {
                $('.loading').css('display', 'flex');
            } else {
                $('.loading').css('display', 'none');
            }
        }).DataTable({
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
                    data: 'name_en',
                    name: 'name_en'
                },
                {
                    data: 'name_th',
                    name: 'name_th'
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
                    data: 'unit',
                    name: 'unit'
                },
                {
                    data: 'supplier',
                    name: 'supplier'
                },
                {
                    data: 'price',
                    name: 'price'
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

        $('#view').on('hidden.bs.modal', function (e) {
            $( '#view-product-loading' ).removeClass( 'd-none' )
            $( '#view-product-data' ).addClass( 'd-none' )
        })
    })

    const viewProduct = function(url) {
        $( "#view" ).modal( "show" )
        $.get(url , function(data, status){
            let res = data.data

            // name
            fillData('name_en', res.name_en)
            fillData('name_th', res.name_th)

            // price
            fillData('price', res.price)

            // desc
            fillData('desc_en', res.desc_en)
            fillData('desc_th', res.desc_th)

            // unit
            fillData('unit_en', res.unit.name_en)
            fillData('unit_th', res.unit.name_th)

            // category
            fillData('category_en', res.category.name_en)
            fillData('category_th', res.category.name_th)

            // brand
            fillData('brand_en', res.brand.name_en)
            fillData('brand_th', res.brand.name_th)

            // supplier
            fillData('supplier_en', res.supplier.name_en)
            fillData('supplier_th', res.supplier.name_th)

            $( '#view-product-loading' ).addClass( 'd-none' )
            $( '#view-product-data' ).removeClass( 'd-none' )
        });
    }

    const fillData = function (id, data) {
        if (data) {
            $( "#" + id ).text( data ).removeClass(" text-danger")
        } else {
            $( "#" + id ).text( '{{ __("No Data") }}' ).addClass(" text-danger")
        }
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
