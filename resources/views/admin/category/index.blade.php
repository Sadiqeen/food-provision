@extends('layouts.app')

@section('title')
{{ __('Category') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-sort-alpha-asc"></i> {{ __('Manage Category') }}</span>
    </h3>
    <div class="row">
        <div class="col-md-4">

            <div class="card mb-4 @error('category_edit') d-none @enderror" id="addCard">
                <div class="card-body">
                    <h4>{{ __('Add Category') }}</h4>
                    <hr/>
                    <form action="{{ route('admin.category.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="category">{{ __('Category') }} <span class="text-danger">*</span></label>
                            <input type="text" name="category" id="category" value="{{ old('category') ?? '' }}"
                                   class="form-control @error('category') is-invalid @enderror" placeholder="">
                            @error('category')
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

            <div class="card mb-4 @if(!$errors->has('category_edit')) d-none @endif" id="editCard">
                <div class="card-body">
                    <h4>
                        {{ __('Edit Category') }} (<span id="editValue">{{ Session::has('old_category') ? Session::get('old_category') : '' }}</span>)
                    </h4>
                    <hr/>
                    <form action="{{ Session::has('update_id') ? route('admin.category.update', Session::get('update_id')) : '' }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="category_edit">{{ __('Category') }} <span class="text-danger">*</span></label>
                            <input type="text" name="category_edit" id="category_edit" value="{{ old('category_edit') ?? '' }}"
                                   class="form-control @error('category_edit') is-invalid @enderror" placeholder="">
                            @error('category_edit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                            <a href="javascript:void(0)" onclick="addCategory()" class="btn btn-warning float-right">{{ __('Add Category') }}</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @include('admin.category.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        const editCategory = function (url, value) {
            $( '#addCard' ).addClass( 'd-none' )
            $( '#editCard' ).removeClass( 'd-none' )
            $( '#editCard form' ).attr( 'action', url )
            $( '#category_edit' ).val( value )
            $( '#editValue' ).text( value )
        }

        const addCategory = function () {
            $( '#addCard' ).removeClass( 'd-none' )
            $( '#editCard' ).addClass( 'd-none' )
        }
    </script>
@endpush
