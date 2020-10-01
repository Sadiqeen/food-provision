<div class="table-responsive-lg position-relative">
    <div class="loading">
        <div class="spinner-grow text-danger" style="width: 5rem; height: 5rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <table class="table table-striped position-relative" id="dataTable">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Image') }}</th>
            <th>{{ __('Product') }}</th>
            <th class="text-center">{{ __('Pack') }}</th>
            <th class="text-center">{{ __('Price') }}</th>
            <th style="width: 25%">{{ __('Quantity') }}</th>
            <th>{{ __('value') }}</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>#</th>
            <th>{{ __('Image') }}</th>
            <th>{{ __('Product') }}</th>
            <th>{{ __('Pack') }}</th>
            <th>{{ __('Price') }}</th>
            <th>{{ __('Quantity') }}</th>
            <th>{{ __('value') }}</th>
        </tr>
        </tfoot>
    </table>
</div>

@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables/datatables.css') }}" />
@endpush

@push('script')
    <script type="text/javascript" src="{{ asset('plugins/DataTables/datatables.js') }}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            let table = $('#dataTable').on('processing.dt', function (e, settings, processing) {
                if (processing) {
                    $('.loading').css('display', 'flex');
                } else {
                    $('.loading').css('display', 'none');
                    $('html, body').animate({
                        scrollTop: $('#navBar').offset().top
                    }, 200);
                }
            }).DataTable({
                serverSide: true,
                responsive: true,
                ajax: '{{ route('admin.order.create.api') }}?category={{ $active_category }}',
                order: [
                    [2, "ASC"]
                ],
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        visible: false,
                        searchable: false
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'desc',
                        name: 'desc'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'value',
                        name: 'value',
                        visible: false,
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

            $('#sortFromAddedItem').click(function() {
                table.order( [ 6, 'DESC' ] ).draw()
            })

        })

    </script>
@endpush
