@extends('layouts.app')

@section('title')
{{ __('Product') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-archive fa-lg mr-2"></i> {{ __('Manage Product') }}</span>
        <a type="button" href="{{ route('admin.product.upload') }}"  class="btn btn-secondary mr-2">{{ __('Import') }}</a>
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
                            <th style="width: 20%">{{ __('Product') }}</th>
                            <th>{{ __('Product') }} {{ __('in Thai language') }}</th>
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
                            <th>{{ __('Product') }} {{ __('in Thai language') }}</th>
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
<form action="" method="post" class="d-none" id="delProduct">
    @csrf
    @method('delete')
</form>
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
            columns: [
                {
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

    const delProduct = function(url) {
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
                $('#delProduct').attr('action', url).submit()
            }
        })
    }
</script>
@endpush
