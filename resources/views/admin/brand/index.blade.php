@extends('layouts.app')

@section('title')
{{ __('Brand') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-sort-alpha-asc"></i> {{ __('Manage Brand') }}</span>
    </h3>
    <div class="row">
        <div class="col-md-4">

            <div class="card mb-4 @error('brand_edit') d-none @enderror" id="addCard">
                <div class="card-body">
                    <h4>{{ __('Add Brand') }}</h4>
                    <hr/>
                    <form action="{{ route('admin.brand.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="brand">{{ __('Brand') }} <span class="text-danger">*</span></label>
                            <input type="text" name="brand" id="brand" value="{{ old('brand') ?? '' }}"
                                   class="form-control @error('brand') is-invalid @enderror" placeholder="">
                            @error('brand')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success" data-cy="create">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-4 @if(!$errors->has('brand_edit')) d-none @endif" id="editCard">
                <div class="card-body">
                    <h4>
                        {{ __('Edit Brand') }} (<span id="editValue">{{ Session::has('old_brand') ? Session::get('old_brand') : '' }}</span>)
                    </h4>
                    <hr/>
                    <form action="{{ Session::has('update_id') ? route('admin.brand.update', Session::get('update_id')) : '' }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="brand_edit">{{ __('Brand') }} <span class="text-danger">*</span></label>
                            <input type="text" name="brand_edit" id="brand_edit" value="{{ old('brand_edit') ?? '' }}"
                                   class="form-control @error('brand_edit') is-invalid @enderror" placeholder="">
                            @error('brand_edit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success" data-cy="update">{{ __('Save') }}</button>
                            <a href="javascript:void(0)" onclick="addBrand()" class="btn btn-warning float-right">{{ __('Add Brand') }}</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @include('admin.brand.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        const editBrand = function (url, value) {
            $( '#addCard' ).addClass( 'd-none' )
            $( '#editCard' ).removeClass( 'd-none' )
            $( '#editCard form' ).attr( 'action', url )
            $( '#brand_edit' ).val( value )
            $( '#editValue' ).text( value )
        }

        const addBrand = function () {
            $( '#addCard' ).removeClass( 'd-none' )
            $( '#editCard' ).addClass( 'd-none' )
        }
    </script>
@endpush
