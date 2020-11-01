@extends('layouts.app')

@section('title')
    {{ __('Import Order') }}
@endsection

@section('content')
    <div class="container">
        <h3 class="my-3 text-uppercase font-weight-bold d-flex">
            <span class="mr-auto"><i class="fa fa-archive fa-lg mr-2"></i> {{ __('Upload Order') }}</span>
            <a type="button" href="{{ route('admin.order.index') }}"
               class="btn btn-secondary">{{ __('Manage Order') }}</a>
        </h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.order.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row" style="min-height: 250px">
                        <div class="col-md-5 m-auto">
                            <h3 class="text-center pb-3">{{ __('Upload Excel File') }}</h3>
                            <div class="form-group pb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('excel') is-invalid @enderror"
                                           name="excel" id="exel">
                                    <label class="custom-file-label" for="customFile">{{ __('Choose file') }}</label>
                                </div>
                                @error('excel')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success">{{ __('Upload') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    $(document).ready(function () {
        $("#exel").change(function () {
            let size = this.files[0].size
            if (size > 2000000) {
                alert('ขนาดไฟล์เกินไป')
                return false;
            }
            let fileName = $(this).val().split('\\').pop()
            $(this).next('.custom-file-label').addClass("selected").text(fileNameFunc(fileName))

            readURL(this);

            $( '#del-img-btn' ).removeClass( 'd-none' )
            $( '#img-upload' ).removeClass( 'd-none' )
        });
    });

    function fileNameFunc(fileName) {
        if (fileName.length > 20) {
            return fileName.substr(0, 20) + '...'
        } else {
            return fileName
        }
    }
</script>
@endpush
