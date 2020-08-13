@extends('layouts.app')

@section('title')
{{ __('Supplier') }}
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <suppier-index :columns-title="props.columnsTitle" :table-config="props.tableConfig"
                url="{{ route('admin.supplier.api') }}"></suppier-index>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    const columnsTitle = [
        "#",
        "{{ __('Name') }}",
        "{{ __('Tel') }}",
        "{{ __('E-mail') }}",
        "{{ __('Address') }}",
        "{{ __('Action') }}"
    ]

    const tableConfig = {
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5 d-inline-flex'i><'col-sm-12 col-md-7'p>>",
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{ route('admin.supplier.api') }}',
        columns: [{
            data: 'id',
            name: 'id',
            visible: false,
            orderable: false,
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
        }],
        @if(app()->getLocale() == "th")
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Thai.json"
            }
        @endif
    }

    const props = {
        columnsTitle: columnsTitle,
        tableConfig: tableConfig
    }

</script>
@endpush
