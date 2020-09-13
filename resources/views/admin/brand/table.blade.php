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
                <th>{{ __('Brand') }}</th>
                <th>{{ __('Product') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tfoot class="bg-success text-white">
            <tr>
                <th>#</th>
                <th>{{ __('Brand') }}</th>
                <th>{{ __('Product') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </tfoot>
    </table>
</div>

{{-- Delete Form --}}
<form action="" method="post" class="d-none" id="delBrand">
    @csrf
    @method('delete')
</form>


@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables/datatables.css') }}" />
@endpush

@push('script')
<script type="text/javascript" src="{{ asset('plugins/DataTables/datatables.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').on('processing.dt', function (e, settings, processing) {
            if (processing) {
                $('.loading').css('display', 'flex');
            } else {
                $('.loading').css('display', 'none');
            }
        }).dataTable({
            serverSide: true,
            responsive: true,
            ajax: '{{ route('admin.brand.api') }}',
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
                    data: 'product_count',
                    name: 'product_count'
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
    })

    const delBrand = function(url) {
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
                $('#delBrand').attr('action', url).submit()
            }
        })
    }
</script>
@endpush
