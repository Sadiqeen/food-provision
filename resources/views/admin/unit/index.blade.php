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
            <div class="card mb-4">
                <div class="card-body">
                    <h4>{{ __('Add Unit') }}</h4>
                    <hr/>
                    <form action="{{ route('admin.unit.store') }}" method="post">
                        @csrf
                        @include('admin.unit.form')

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
                    @include('admin.unit.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
