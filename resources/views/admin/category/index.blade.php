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
            <div class="card">
                <div class="card-body">
                    <h4>{{ __('Add Category') }}</h4>
                    <hr/>
                    <form action="{{ route('admin.category.store') }}" method="post">
                        @csrf
                        @include('admin.category.form')

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
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
