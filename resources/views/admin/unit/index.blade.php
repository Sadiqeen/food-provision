@extends('layouts.app')

@section('title')
{{ __('Unit') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-sort-alpha-asc"></i> {{ __('Manage Unit') }}</span>
    </h3>
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 @error('unit_edit') d-none @enderror" id="addCard">
                <div class="card-body">
                    <h4>{{ __('Add Unit') }}</h4>
                    <hr/>
                    <form action="{{ route('admin.unit.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="unit">{{ __('Unit') }} <span class="text-danger">*</span></label>
                            <input type="text" name="unit" id="unit" value="{{ old('unit') ?? '' }}"
                                   class="form-control @error('unit') is-invalid @enderror" placeholder="">
                            @error('unit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-4 @if(!$errors->has('unit_edit')) d-none @endif" id="editCard">
                <div class="card-body">
                    <h4>
                        {{ __('Edit Unit') }} (<span id="editValue"> {{ Session::has('old_unit') ? Session::get('old_unit') : '' }}</span>)
                    </h4>
                    <hr/>
                    <form action="{{ Session::has('update_id') ? route('admin.unit.update', Session::get('update_id')) : '' }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="unit_edit">{{ __('Unit') }} <span class="text-danger">*</span></label>
                            <input type="text" name="unit_edit" id="unit_edit" value="{{ old('unit_edit') ?? '' }}"
                                   class="form-control @error('unit_edit') is-invalid @enderror" placeholder="">
                            @error('unit_edit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                            <a href="javascript:void(0)" onclick="addUnit()" class="btn btn-warning float-right">{{ __('Add Unit') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @include('admin.unit.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        const editUnit = function (url, value) {
            $( '#addCard' ).addClass( 'd-none' )
            $( '#editCard' ).removeClass( 'd-none' )
            $( '#editCard form' ).attr( 'action', url )
            $( '#unit_edit' ).val( value )
            $( '#editValue' ).text( value )
        }

        const addUnit = function () {
            $( '#addCard' ).removeClass( 'd-none' )
            $( '#editCard' ).addClass( 'd-none' )
        }
    </script>
@endpush
