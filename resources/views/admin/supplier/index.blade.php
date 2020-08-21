@extends('layouts.app')

@section('title')
{{ __('Supplier') }}
@endsection

@section('content')
<div class="container">
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
@endsection

@push('style')
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables/datatables.css') }}"/>
@endpush

@push('script')
<script type="text/javascript" src="{{ asset('plugins/DataTables/datatables.js') }}"></script>
<script>
$(document).ready( function () {
    $('#dataTable').on( 'processing.dt', function ( e, settings, processing ) {
        if (processing) {
            $('.loading').css( 'display', 'flex' );
        } else {
            $('.loading').css( 'display', 'none' );
        }
    }).dataTable({
        serverSide: true,
        responsive: true,
        ajax: '{{ route('admin.supplier.api') }}',
        order: [[ 0, "DESC" ]],
        columns: [
          { data: 'id', name: 'id', visible: false, searchable: false },
          { data: 'name', name: 'name' },
          { data: 'tel', name: 'tel' },
          { data: 'email', name: 'email' },
          { data: 'address', name: 'address' },
          { data: 'action', name: 'action' }
        ],
        @if(app()->getLocale() == "th")
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Thai.json"
            }
        @endif
    })
});
</script>
@endpush
